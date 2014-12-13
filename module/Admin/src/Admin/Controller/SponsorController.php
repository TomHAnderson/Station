<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use Admin\Form;

class SponsorController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsors = $objectManager->getRepository('Db\Entity\Sponsor')->findAll(['name' => 'ASC']);

        return new ViewModel([
            'sponsors' => $sponsors
        ]);
    }

    public function createAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
die('create');
        $form = new Form\Sponsor();

        return new ViewModel([
            'form' => $form
        ]);
    }
}
