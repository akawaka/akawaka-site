<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Write\ResetPassword;

use App\Security\Domain\Entity\User;
use Mono\Bundle\AkaBundle\Shared\Domain\Entity\UserInterface;

final class Command
{
    public function __construct(
        private UserInterface $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
