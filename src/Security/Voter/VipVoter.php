<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class VipVoter extends Voter
{
    public const VIP = 'VOTER_VIP';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::VIP]);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::VIP:
                if (in_array('ROLE_VIP', $user->getRoles())) {
                    return true;
                }
                break;
        }

        return false;
    }
}
