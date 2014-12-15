<?php

namespace Db\Repository;

use Doctrine\ORM\EntityRepository;

class SponsorRepository extends EntityRepository
{
    public function getSponsorsAsValueOptions()
    {
        $sponsors = $this->findBy([], ['name' => 'ASC']);

        $valueOptions = [];
        foreach ($sponsors as $sponsor) {
            $valueOptions[$sponsor->getId()] = $sponsor->getName();
        }

        return $valueOptions;
    }
}