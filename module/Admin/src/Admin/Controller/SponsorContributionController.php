<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use Admin\Form;
use UnexpectedValueException;
use DateTime;

class SponsorContributionController extends AbstractActionController
{
    public function detailAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsorContribution = $objectManager->getRepository('Db\Entity\SponsorContribution')->find($this->params()->fromRoute('id'));

        if (!$sponsorContribution) {
            $this->plugin('Meetup')->unAuthorized();
        }

        return new ViewModel([
            'sponsorContribution' => $sponsorContribution,
        ]);
    }

    public function editAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsorContribution = $objectManager->getRepository('Db\Entity\SponsorContribution')->find($this->params()->fromRoute('id'));

        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\SponsorContribution');
        // Load filtered list of events for select
        $form->get('event')->setValueOptions($objectManager->getRepository('Db\Entity\Event')->getEventsAsValueOptions($sponsorContribution->getMeetupGroup()));

        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($sponsorContribution->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $sponsorContribution->exchangeArray($form->getData());

                $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromPost('sponsor'));
                if (!$sponsor) {
                    throw new UnexpectedValueException('Sponsor not found');
                }
                $sponsorContribution->setSponsor($sponsor);

                $event = $objectManager->getRepository('Db\Entity\Event')->find($this->params()->fromPost('event'));
                if ($event) {
                    $sponsorContribution->setEvent($event);
                }

                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/sponsor-contribution', ['id' => $sponsorContribution->getId()]);
            }
        } else {
            $form->setData($sponsorContribution->getArrayCopy());
        }

        return new ViewModel([
            'sponsorContribution' => $sponsorContribution,
            'form' => $form
        ]);
    }

    public function createAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromRoute('id'));

        if ($this->params()->fromRoute('event_id')) {
            $event = $objectManager->getRepository('Db\Entity\Event')->find($this->params()->fromRoute('event_id'));
        } else {
            $event = null;
        }

        $form = $this->getServiceLocator()->get('FormElementManager')->get('Admin\Form\SponsorContribution');

        // Load filtered list of events for select
        $form->get('event')->setValueOptions($objectManager->getRepository('Db\Entity\Event')->getEventsAsValueOptions($meetupGroup));

        if ($this->getRequest()->isPost()) {
            $sponsorContribution = new Entity\SponsorContribution();

            $form->setInputFilter($sponsorContribution->getInputFilter());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $sponsorContribution->exchangeArray($form->getData());
                $sponsorContribution->setMeetupGroup($meetupGroup);
                $sponsorContribution->setCreatedAt(new DateTime());

                $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->find($this->params()->fromPost('sponsor'));
                if (!$sponsor) {
                    throw new UnexpectedValueException('Sponsor not found');
                }
                $sponsorContribution->setSponsor($sponsor);

                $event = $objectManager->getRepository('Db\Entity\Event')->find($this->params()->fromPost('event'));
                if ($event) {
                    $sponsorContribution->setEvent($event);
                }

                $objectManager->persist($sponsorContribution);
                $objectManager->flush();

                return $this->plugin('redirect')->toRoute('admin/sponsor-contribution', ['id' => $sponsorContribution->getId()]);
            }
        } else {
            if ($event) {
                $form->setData(['event' => $event->getId()]);
            }
        }

        return new ViewModel([
            'meetupGroup' => $meetupGroup,
            'form' => $form,
            'event' => $event,
        ]);
    }

    public function deleteAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $sponsorContribution = $objectManager->getRepository('Db\Entity\SponsorContribution')->find($this->params()->fromRoute('id'));

        $meetupGroupId = $sponsorContribution->getMeetupGroup()->getId();

        if ($sponsorContribution) {
            $objectManager->remove($sponsorContribution);
            $objectManager->flush();
        }

        return $this->plugin('redirect')->toRoute('admin/meetup-group/sponsor-contribution', ['id' => $meetupGroupId]);
    }
}
