<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use DateTime;

class EventController extends AbstractActionController
{
    public function detailAction()
    {
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $event = $objectManager->getRepository('Db\Entity\Event')->find($this->params()->fromRoute('id'));

        if (!$event) {
            $this->plugin('Meetup')->unAuthorized();
        }

        return new ViewModel([
            'event' => $event
        ]);
    }

    public function refreshAllAction()
    {
        $this->plugin('Meetup')->validateMeetupGroupPermission($this->params()->fromRoute('id'), 'any', true);
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($this->params()->fromRoute('id'));

        $meetup = $this->getServiceLocator()->get('MeetupClient');
        $meetupEvents = $meetup->getEvents(['group_id' => $meetupGroup->getId(), 'status' => 'upcoming,past'])->toArray();

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

                    // Match sponsor by venue name
                    $sponsor = $objectManager->getRepository('Db\Entity\Sponsor')->findOneBy([
                        'name' => trim($meetupEvent['venue']['name']),
                    ]);
                    if ($sponsor) {
                        $venue->setSponsor($sponsor);

                        // Save a sponsor contribution for each venue
                        if ($sponsor) {
                            $sponsorContribution = new Entity\SponsorContribution();
                            $sponsorContribution->setCreatedAt(new DateTime());
                            $sponsorContribution->setMeetupGroup($meetupGroup);
                            $sponsorContribution->setSponsor($sponsor);
                            $sponsorContribution->setEvent($event);
                            $sponsorContribution->setTitle('Automated Venue Host');
                            $sponsorContribution->setDescription("Event was hosted at sponsor's venue");

                            $objectManager->persist($sponsorContribution);
                        }
                    }

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
