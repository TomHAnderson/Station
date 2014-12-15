<?php

namespace Admin\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\Authentication\AuthenticationService;

class MeetupGroupSelectFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $formElementManager)
    {
        $element = new Select();
        $valueOptions = $this->loadValueOptions($formElementManager);
        $element->setValueOptions($valueOptions);

        return $element;
    }

    protected function loadValueOptions(ServiceLocatorInterface $formElementManager)
    {
        $serviceManager = $formElementManager->getServiceLocator();
        $repository = $serviceManager->get('doctrine.entitymanager.orm_default')->getRepository('Db\Entity\MeetupGroup');

        return $repository->getMeetupGroupsAsValueOptions($this->getAuthenticatedMember($formElementManager));
    }

    public function getAuthenticatedMember(ServiceLocatorInterface $formElementManager)
    {
        $authService = new AuthenticationService();
        $serviceManager = $formElementManager->getServiceLocator();
        $objectManager = $serviceManager->get('doctrine.entitymanager.orm_default');

        return $objectManager->getRepository('Db\Entity\Member')->find($authService->getIdentity()->getId());
    }
}