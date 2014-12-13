<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Authentication\AuthenticationService;
use BjyAuthorize\Exception\UnAuthorizedException;

class Meetup extends AbstractPlugin implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function getMember()
    {
        $objectManager = $this->getServiceLocator()->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $authService = new AuthenticationService();
        if ($authService->hasIdentity()) {
            $member = $objectManager->getRepository('Db\Entity\Member')->find($authService->getIdentity()->getId());

            return $member;
        }

        return null;
    }

    public function unAuthorized()
    {
        throw new UnAuthorizedException();
    }

    public function validateMeetupGroupPermission($meetupGroupId, $permission, $override = true)
    {
        # FIXME:  override is for debugging only
        if ($override) return true;
        $objectManager = $this->getServiceLocator()->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meetupGroup = $objectManager->getRepository('Db\Entity\MeetupGroup')->find($meetupGroupId);

        $memberProfile = null;
        foreach ($this->getMember()->getProfile() as $profile) {
            if ($profile->getMeetupGroup() == $meetupGroup) {
                $memberProfile = $profile;
                break;
            }
        }

        // The member must have role permissions for this group
        # FIXME:  Improve to use Meetup permission authorize tree
        if (!$memberProfile or !$memberProfile->getRole() or $memberProfile->getRole() !== $permission) {
            $this->unAuthorized();
        }

        return true;
    }
}
