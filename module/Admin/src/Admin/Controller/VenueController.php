<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;

class VenueController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venue = $objectManager->getRepository('Db\Entity\Venue')->find($this->params()->fromRoute('id'));

        if (!$venue) {
            $this->plugin('Meetup')->unAuthorized();
        }

        return new ViewModel(['venue' => $venue]);
    }
}
