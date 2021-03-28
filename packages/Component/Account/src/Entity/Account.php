<?php

declare(strict_types=1);

namespace Black\Component\Account\Entity;

use Black\Bundle\HadesBundle\Domain\DateInterface;
use Safe\DateTimeImmutable;

class Account implements AccountInterface, DateInterface
{
    protected \DateTimeImmutable $dateCreated;

    protected ?\DateTimeImmutable $dateUpdated;

    public function __construct()
    {
        $this->dateUpdated = null;
        $this->dateCreated = new \DateTimeImmutable();
    }

    public function getDateCreated(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->dateCreated);
    }

    public function getDateUpdated(): ?DateTimeImmutable
    {
        return new DateTimeImmutable($this->dateUpdated);
    }
}
