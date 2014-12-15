<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use Admin\Form;
use UnexpectedValueException;

class SponsorContactController extends AbstractActionController
{
    public function editAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsorContact = $objectManager->getRepository('Db\Entity\SponsorContact')->find($this->params()->fromRoute('id'));

        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\SponsorContact');

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($sponsorContact->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $sponsorContact->exchangeArray($form->getData());

                $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromPost('meetupGroup'));
                if (!$meetupGroup) {
                    throw new UnexpectedValueException('Meetup group not found');
                }
                $sponsorContact->setMeetupGroup($meetupGroup);

                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/sponsor/detail', ['id' => $sponsorContact->getSponsor()->getId()]);
            }
        } else {
            $form->setData($sponsorContact->getArrayCopy());
        }

        return new ViewModel([
            'sponsorContact' => $sponsorContact,
            'form' => $form
        ]);
    }

    public function createAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\SponsorContact');
        $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromRoute('sponsor_id'));

        if ($this->getRequest()->isPost()) {
            $sponsorContact = new Entity\SponsorContact();

            $form->setInputFilter($sponsorContact->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $sponsorContact->exchangeArray($form->getData());
                $sponsorContact->setSponsor($sponsor);

                $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromPost('meetupGroup'));
                if (!$meetupGroup) {
                    throw new UnexpectedValueException('Meetup group not found');
                }
                $sponsorContact->setMeetupGroup($meetupGroup);

                $objectManager->persist($sponsorContact);
                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/sponsor/detail', ['id' => $sponsor->getId()]);
            }
        }

        return new ViewModel([
            'sponsor' => $sponsor,
            'form' => $form
        ]);
    }

    public function deleteAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsorContact = $objectManager->getRepository('Db\Entity\SponsorContact')->find($this->params()->fromRoute('id'));

        $sponsorId = $sponsorContact->getSponsor()->getId();

        if ($sponsorContact) {
            $objectManager->remove($sponsorContact);
            $objectManager->flush();
        }

        return $this->plugin('redirect')->toRoute('admin/sponsor/detail', ['id' => $sponsorId]);
    }
}
