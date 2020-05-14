<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use \App\Entity\Rooms;
use Symfony\Component\Security\Core\Security;

class RoomVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT_VIEW','CREATE'])
            && $subject instanceof Rooms;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT_VIEW':
                if ($this->security->isGranted('ROLE_ADMIN')) {
                    return true;
                }
                if ( $this->security->isGranted('ROLE_SUPER_ADMIN')) {
                    return true;
                }
                return false;

            case 'CREATE':
                if ( $this->security->isGranted(['ROLE_ADMIN'])) {
                    return true;
                }

                return false;
        }

        return false;
    }
}
