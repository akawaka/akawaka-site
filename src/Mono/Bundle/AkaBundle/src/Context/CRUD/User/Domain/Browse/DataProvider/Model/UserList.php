<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model;

final class UserList implements UserListInterface
{
    public function __construct(
        private array $users = []
    ) {
    }

    public function add(UserInterface $user): void
    {
        if (!$this->contains($user)) {
            $this->users[] = $user;
        }
    }

    public function contains(UserInterface $user): bool
    {
        return in_array($user, $this->users, true);
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}
