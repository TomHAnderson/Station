<?php

namespace Application\Provider\Identity;

use Zend\Authentication\AuthenticationService;
use BjyAuthorize\Provider\Identity\ProviderInterface;

class Meetup implements ProviderInterface
{
    use \DoctrineModule\Persistence\ProvidesObjectManager;

    public function getIdentityRoles()
    {
        $authService = new AuthenticationService();

        $return = ['guest'];
        if ($authService->hasIdentity()) {
            $user = $this->getObjectManager()->getRepository('Db\Entity\Member')->find($authService->getIdentity()->getId());

            // Update user last Request At anytime roles are loaded
            if ($user) {

                // This is a little hack.  If the user has no roles
                // then the oauth2 will infinitly loop.  This happens
                // when a session exists for the current user on a new install
                // (delete your cookies if reinstalling)
                if (!sizeof($user->getRole())) {
                    $this->getObjectManager()->remove($user);
                    $this->getObjectManager()->flush();
                }

                foreach ($user->getRole() as $role) {
                    $return[] = $role->getRoleId();
                }
            }
        }

        return $return;
    }
}
