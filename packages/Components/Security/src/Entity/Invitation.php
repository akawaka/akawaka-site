<?php

declare(strict_types=1);

namespace Black\Component\Security\Entity;

use Ramsey\Uuid\Uuid;

class Invitation implements InvitationInterface
{
    protected string $code;

    protected string $email;

    protected \DateTimeImmutable $dateCreated;

    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->dateCreated = new \DateTimeImmutable();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->dateCreated;
    }
}
