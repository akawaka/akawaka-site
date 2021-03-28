<?php

declare(strict_types=1);

namespace Black\Component\Security\Entity;

interface InvitationInterface
{
    public function getEmail(): string;

    public function getCode(): string;

    public function getDateCreated(): \DateTimeInterface;
}
