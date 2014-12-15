<?php

namespace Admin\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class SponsorSelectFactory implements FactoryInterface
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
        $repository = $serviceManager->get('doctrine.entitymanager.orm_default')->getRepository('Db\Entity\Sponsor');

        return $repository->getSponsorsAsValueOptions();
    }

}