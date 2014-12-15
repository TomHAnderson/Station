<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Stuki\OAuth2\Client;
use Zend\Session\Container;
use Zend\Authentication\Result;
use Application\Service\MeetupClient;
use Application\Authentication\Adapter\Meetup as MeetupAdapter;
use DateTime;
use DateInterval;

class AuthenticationController extends AbstractActionController
{
    public function logoutAction()
    {
        session_unset();
        session_destroy();

        return $this->plugin('redirect')->toRoute('home');
    }

    public function indexAction()
    {
        $config = $this->getServiceLocator()->get('Config');

        $provider = new Client\Provider\Meetup(array(
            'clientId' => $config['meetup']['key'],
            'clientSecret' => $config['meetup']['secret'],
            'redirectUri' => $config['meetup']['redirect'],
        ));

        if (! $this->params()->fromQuery('code')) {
            // No authorization code; send user to get one
            // Some providers support and/or require an application state token
            return $this->plugin('redirect')->toUrl($provider->getAuthorizationUrl(array('state' => 'token')));
        } else {
            try {
                // Get an authorization token
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code'],
                ]);
            } catch (Client\Exception\IDPException $e) {
                return $this->plugin('redirect')->toRoute('authentication/error');
            }

            // The adapter is built here instead of a service manager so the session can store
            // the tokens and it will pass this first run.
            $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
            $adapter = new MeetupAdapter();
            $adapter->setObjectManager($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
            $adapter->setMeetupClient(MeetupClient::factory(['access_token' => $token->accessToken]));

            $result = $authService->authenticate($adapter);

            switch ($result->getCode()) {
                case Result::FAILURE:
                    return $this->plugin('redirect')->toRoute('authentication/error');
                    break;
                case Result::SUCCESS:
                    // Set the expire time for the access tokens
                    $expire = new DateTime();
                    $expire->add(new DateInterval('PT' . $token->expires_in . 'S'));

                    // Store the access and refresh token for future use
                    $container = new Container('oauth2');
                    $container->accessToken = $token->accessToken;
                    $container->refreshToken = $token->refreshToken;
                    $container->accessTokenExpire = $expire;

                    return $this->plugin('redirect')->toRoute('member');
                    break;
                default:
                    throw new \Exception('An unexpected authentication result was returned');
                    break;
            }
        }
    }

    public function errorAction()
    {
        return [];
    }
}
