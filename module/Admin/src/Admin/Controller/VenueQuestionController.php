<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use Admin\Form;
use UnexpectedValueException;

class VenueQuestionController extends AbstractActionController
{
    public function indexAction()
    {
        // This is a placeholder route for create/edit/delete subroutes
        $this->plugin('Meetup')->unAuthorized();
    }

    public function createAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $venue = $objectManager->getRepository('Db\Entity\Venue')->find($this->params()->fromRoute('venue_id'));
        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\VenueQuestion');

        if ($this->getRequest()->isPost()) {
            $venueQuestion = new Entity\VenueQuestion();

            $form->setInputFilter($venueQuestion->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $venueQuestion->exchangeArray($form->getData());
                $venueQuestion->setVenue($venue);

                $objectManager->persist($venueQuestion);
                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/venue/detail', ['id' => $venueQuestion->getVenue()->getId()]);
            }
        }

        return new ViewModel([
            'venue' => $venue,
            'form' => $form
        ]);
    }

    public function editAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venueQuestion = $objectManager->getRepository('Db\Entity\VenueQuestion')->find($this->params()->fromRoute('id'));

        if (!$venueQuestion) {
            $this->plugin('Meetup')->unAuthorized();
        }

        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\VenueQuestion');

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($venueQuestion->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $venueQuestion->exchangeArray($form->getData());
                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/venue/detail', ['id' => $venueQuestion->getVenue()->getId()]);
            }
        } else {
            $form->setData($venueQuestion->getArrayCopy());
        }

        return new ViewModel([
            'venueQuestion' => $venueQuestion,
            'form' => $form
        ]);
    }

    public function deleteAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venueQuestion= $objectManager->getRepository('Db\Entity\VenueQuestion')->find($this->params()->fromRoute('id'));

        $venueId = $venueQuestion->getVenue()->getId();

        if ($venueQuestion) {
            $objectManager->remove($venueQuestion);
            $objectManager->flush();
        }

        return $this->plugin('redirect')->toRoute('admin/venue/detail', ['id' => $venueId]);
    }
}
