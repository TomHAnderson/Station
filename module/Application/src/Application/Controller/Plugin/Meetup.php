<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Authentication\AuthenticationService;

class Meetup extends AbstractPlugin implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function getMember()
    {
        $objectManager = $this->getServiceLocator()->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $authService = new AuthenticationService();
        if ($authService->hasIdentity()) {
            $member = $objectManager->getRepository('Db\Entity\Member')->find($authService->getIdentity()->getId());

            return $member;
        }

        return null;
    }
}
