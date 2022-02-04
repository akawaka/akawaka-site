<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model;

interface UserListInterface
{
    public function add(UserInterface $user): void;

    public function contains(UserInterface $user): bool;

    public function getUsers(): array;
}
