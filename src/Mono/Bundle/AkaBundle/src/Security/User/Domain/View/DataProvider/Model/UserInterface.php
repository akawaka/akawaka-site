<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Domain\View\DataProvider\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

interface UserInterface
{
    public function getId(): UserId;

    public function getUsername(): Username;

    public function getEmail(): EmailAddress;

    public function getPassword(): string;

    public function getRegistrationDate(): \DateTimeImmutable;

    public function getLastUpdate(): ?\DateTimeImmutable;

    public function getLastConnection(): ?\DateTimeImmutable;
}
