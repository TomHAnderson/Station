<?php

namespace Station\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;

class MemberController extends AbstractActionController
{
    public function indexAction()
    {
        // Members are directed here after logging in.  If the member has
        // no group profiles then request them from meetup.  Also allow for
        // manual profile updates

        $member = $this->plugin('Meetup')->getMember();

        return new ViewModel([
            'member' => $member,
        ]);
    }

    /**
     * Refresh the users profiles from meetup
     */
    public function refreshAction()
    {
        $meetup = $this->getServiceLocator()->get('MeetupClient');
        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $member = $this->plugin('Meetup')->getMember();
        $profiles = $meetup->getGroupProfiles(['member_id' => $member->getId()]);

        foreach ($profiles as $profile) {
            $meetupGroup = $objectManager->find($profile['group']['id']);

            if (!$meetupGroup) {
                $meetupGroup = new Entity\MeetupGroup();
                $meetupGroup->exchangeArray($profile['group']);
                $objectManager->persist($meetupGroup);
            }
        }

        die();
    }
}
