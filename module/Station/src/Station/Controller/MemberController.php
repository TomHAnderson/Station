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
        $meetupProfiles = $meetup->getGroupProfiles(['member_id' => $member->getId()]);

        foreach ($meetupProfiles as $meetupProfile) {
            $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($meetupProfile['group']['id']);

            // Refreshing of meetup groups is an administrative function
            // Add if not found
            if (!$meetupGroup) {
                $meetupGroup = new Entity\MeetupGroup();
                $meetupGroup->setId($meetupProfile['group']['id']);
                $meetupGroup->exchangeArray($meetupProfile['group']);
                $objectManager->persist($meetupGroup);
            }

            $profile = $objectManager->getRepository('Db\Entity\Profile')->findOneBy([
                'member' => $member,
                'meetupGroup' => $meetupGroup,
            ]);

            // Create or update profile
            if (!$profile) {
                $profile = new Entity\Profile();
                $profile->setMember($member);
                $profile->setMeetupGroup($meetupGroup);
                $objectManager->persist($profile);
            }
            $profile->exchangeArray($meetupProfile);

            // Create or update the the profile photo
            if (isset($meetupProfile['photo'])) {
                $photo = $profile->getProfilePhoto();

                if (!$photo) {
                    $photo = new Entity\ProfilePhoto();
                    $photo->setId($meetupProfile['photo']['photo_id']);
                    $photo->setProfile($profile);
                    $objectManager->persist($photo);
                }

                $photo->exchangeArray($meetupProfile['photo']);
            } else {
                $objectManager->remove($profile->getProfilePhoto());
            }

            // Clear answers and recreate
            if ($profile->getProfileAnswer()) {
                foreach ($profile->getProfileAnswer() as $answer) {
                    $objectManager->remove($answer);
                }
            }

            if (isset($meetupProfile['answers']) and is_array($meetupProfile['answers'])) {
                foreach ($meetupProfile['answers'] as $meetupAnswer) {
                    $answer = new Entity\ProfileAnswer();
                    $objectManager->persist($answer);
                    $answer->exchangeArray($meetupAnswer);
                }
            }
        }

        $objectManager->flush();

        die('add groups done');
    }
}
