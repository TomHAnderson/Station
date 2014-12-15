<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use Admin\Form;
use UnexpectedValueException;

class VenueController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venues = $objectManager->getRepository('Db\Entity\Venue')->findBy([], ['name' => 'ASC']);

        return new ViewModel([
            'venues' => $venues
        ]);
    }

    public function detailAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venue = $objectManager->getRepository('Db\Entity\Venue')->find($this->params()->fromRoute('id'));

        if (!$venue) {
            $this->plugin('Meetup')->unAuthorized();
        }

        return new ViewModel(['venue' => $venue]);
    }

    public function editAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venue = $objectManager->getRepository('Db\Entity\Venue')->find($this->params()->fromRoute('id'));

        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\Venue');

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($venue->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $venue->exchangeArray($form->getData());

                // Set select options
                if ($this->params()->fromPost('sponsor')) {
                    $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromPost('sponsor'));
                    if (!$sponsor) {
                        throw new UnexpectedValueException('Sponsor not found');
                    }
                    $venue->setSponsor($sponsor);
                }

                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/venue/detail', ['id' => $venue->getId()]);
            }
        } else {
            $form->setData($venue->getArrayCopy());
        }

        return new ViewModel([
            'venue' => $venue,
            'form' => $form
        ]);
    }
}
