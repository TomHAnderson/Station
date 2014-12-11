<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;
use Application\Service\MeetupClient;
use Zend\Session\Container;
use Zend\Authentication\AuthenticationService;
use Application\Authentication\Adapter\Meetup as MeetupAdapter;
use Exception;
use DateTime;
use DateInterval;
use Stuki\OAuth2\Client;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        try {
            $strategy = $e->getApplication()->getServiceManager()->get('BjyAuthorizeViewRedirectionStrategy');
            $strategy->setRedirectRoute('authentication');

            $session = $e->getApplication()
                ->getServiceManager()
                ->get('Zend\Session\SessionManager');
            $session->start();
        } catch (Exception $exception) {
            // This will allow the command line to run without breaking when BjyAuthorize is
            // removed from application.config.php
        }

    }

    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.'/src/'.__NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'MeetupClient' => function (ServiceManager $serviceManager) {
                    $container = new Container('oauth2');
                    if (isset($container->accessToken)) {
                        $now = new DateTime();
                        if ($container->accessTokenExpire <= $now) {
                            // Access token has expired, refresh token
                            $config = $serviceManager->get('Config');

                            $provider = new Client\Provider\Meetup(array(
                                'clientId' => $config['meetup']['key'],
                                'clientSecret' => $config['meetup']['secret'],
                                'redirectUri' => $config['meetup']['redirect'],
                            ));

                            $token = $provider->getAccessToken('refresh_token', [
                                'refresh_token' => $container->refreshToken,
                            ]);

                            // Set the expire time for the new access token
                            $expire = new DateTime();
                            $expire->add(new DateInterval('PT' . $token->expires_in . 'S'));

                            // Store the access and refresh token for future use
                            $container->accessToken = $token->accessToken;
                            $container->refreshToken = $token->refreshToken;
                            $container->accessTokenExpire = $expire;
                        }

                        $accessToken = $container->accessToken;

                        // Use the refresh token every time this is called?
                    } else {
                        throw new Exception('The oauth2 session is not configured');
                    }

                    $client = MeetupClient::factory(['access_token' => $accessToken]);

                    return $client;
                },

                'MeetupProviderIdentity' => function (ServiceManager $serviceManager) {
                    $provider = new \Application\Provider\Identity\Meetup();
                    $provider->setObjectManager($serviceManager->get('doctrine.entitymanager.orm_default'));

                    return $provider;
                },

                'Zend\Authentication\AuthenticationService' => function (ServiceManager $serviceManager) {
                    $adapter = new MeetupAdapter();
                    $adapter->setObjectManager($serviceManager->get('doctrine.entitymanager.orm_default'));

                    try {
                        $client = $serviceManager->get('MeetupClient');
                        $adapter->setMeetupClient($client);
                    } catch (Exception $e) {
                        #  don't set client if session does not contain oauth2
                    }

                    $authentication = new AuthenticationService();
                    $authentication->setAdapter($adapter);

                    return $authentication;
                },
            ),
        );
    }
}
