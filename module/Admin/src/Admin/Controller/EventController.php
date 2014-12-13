<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;

class EventController extends AbstractActionController
{
    public function refreshAllAction()
    {
        $this->plugin('Meetup')->validateMeetupGroupPermission($this->params()->fromRoute('id'), 'any', true);
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromRoute('id'));

        $meetup = $this->getServiceLocator()->get('MeetupClient');
        $meetupEvents = $meetup->getEvents(['group_id' => $meetupGroup->getId()])->toArray();

        foreach ($meetupEvents as $meetupEvent) {
            $event = $objectManager->getRepository('Db\Entity\Event')->find($meetupEvent['id']);

            if (!$event) {
                $event = new Entity\Event();
                $event->setId($meetupEvent['id']);
                $event->setMeetupGroup($meetupGroup);
                $objectManager->persist($event);
            }

            $event->exchangeArray($meetupEvent);

            if (isset($meetupEvent['venue']) and isset($meetupEvent['venue']['id'])) {
                $venue = $objectManager->getRepository('Db\Entity\Venue')->find($meetupEvent['venue']['id']);

                if (!$venue) {
                    $venue = new Entity\Venue();
                    $venue->setId($meetupEvent['venue']['id']);
                    $objectManager->persist($venue);
                }

                $venue->exchangeArray($meetupEvent['venue']);
                $event->setVenue($venue);
            }
        }

        $objectManager->flush();

        return $this->plugin('redirect')->toRoute('admin/meetup-group', ['id' => $meetupGroup->getId()]);
    }
}
