<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUsers;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Symfony\Component\Security\Core\User\UserInterface;

final class Response implements GatewayResponse
{
    private ArrayCollection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function add(UserInterface $user): void
    {
        $this->users->add(new UserResponse($user));
    }

    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    public function data(): array
    {
        return $this->getUsers()->map(function (UserResponse $user) {
            return $user->data();
        })->toArray();
    }
}
