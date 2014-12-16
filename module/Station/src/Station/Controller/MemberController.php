<?php

namespace Station\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity;
use UnexpectedValueException;

class MemberController extends AbstractActionController
{
    public function indexAction()
    {
        // Members are directed here after logging in.  If the member has
        // no group profiles then request them from meetup.  Also allow for
        // manual profile updates

        $member = $this->plugin('Meetup')->getMember();

        if (!sizeof($member->getProfile())) {
            return $this->plugin('redirect')->toRoute('member/refresh');
        }

        return $this->plugin('redirect')->toRoute('member/detail', ['id' => $member->getId()]);
    }

    public function detailAction()
    {
        $member = $this->plugin('Meetup')->getMember();

        if ($member->getId() != $this->params()->fromRoute('id')) {
            throw new UnexpectedValueException('Your logged in member id does not match the requested id');
        }

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

        if (!$meetupProfiles) {
            throw new Exception('You are not a member of any Meetup groups.  Join a group through meetup.com and try again.');
        }

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
                    $photo = $objectManager->getRepository('Db\Entity\ProfilePhoto')->find($meetupProfile['photo']['photo_id']);

                    if (!$photo) {
                        $photo = new Entity\ProfilePhoto();
                        $photo->setId($meetupProfile['photo']['photo_id']);
                        $objectManager->persist($photo);
                    }
                }

                $photo->exchangeArray($meetupProfile['photo']);
                $profile->setProfilePhoto($photo);
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

        return $this->plugin('redirect')->toRoute('member');
    }
}
