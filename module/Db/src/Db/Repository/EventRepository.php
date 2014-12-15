<?php

namespace Db\Repository;

use Doctrine\ORM\EntityRepository;
use Db\Entity;

class EventRepository extends EntityRepository
{
    public function getEventsAsValueOptions(Entity\MeetupGroup $meetupGroup)
    {
        $events = $this->findBy([
            'meetupGroup' => $meetupGroup
        ], ['scheduledAt' => 'DESC']);

        $valueOptions = [];
        foreach ($events as $event) {
            $valueOptions[$event->getId()] = $event->getScheduledAtWithOffset()->format('Y-m-d H:i:s')
            . ' ' . $event->getName();
        }

        return $valueOptions;
    }
}