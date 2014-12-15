<?php

namespace Db\Repository;

use Doctrine\ORM\EntityRepository;
use Db\Entity;

class MeetupGroupRepository extends EntityRepository
{
    public function getMeetupGroupsAsValueOptions(Entity\Member $member)
    {
        $meetupGroups = $this->findBy([], ['name' => 'ASC']);

        $valueOptions = [];
        foreach ($meetupGroups as $meetupGroup) {
            foreach ($member->getProfile() as $profile) {
                if ($profile->getMeetupGroup() == $meetupGroup) {
                    $valueOptions[$meetupGroup->getId()] = $meetupGroup->getName();
                    break;
                }
            }
        }

        return $valueOptions;
    }
}