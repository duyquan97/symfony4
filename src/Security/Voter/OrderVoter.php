<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderVoter extends Voter
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
        return in_array($attribute, ['ACCEPT','SHOW','NEW'])
            && $subject instanceof \App\Entity\Order;
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
            case 'ACCEPT':
                if ($this->security->isGranted('ROLE_ADMIN')){
                    return true;
                }
                return false;
            case 'SHOW':
                if ($subject->getUser() == $user || $this->security->isGranted('ROLE_ADMIN')){
                    return true;
                }
                return false;
            case 'NEW':
                if ( !$this->security->isGranted('ROLE_ADMIN') && $this->security->isGranted('ROLE_USER') ){
                    return true;
                }
                if ( $this->security->isGranted('ROLE_SUPER_ADMIN')){
                    return true;
                }
                return false;
        }

        return false;
    }
}
