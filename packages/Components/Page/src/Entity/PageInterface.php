<?php

declare(strict_types=1);

namespace Black\Component\Page\Entity;

interface PageInterface
{
    public function getName(): string;

    public function getSlug(): string;

    public function getContent(): string;

    public function getStatus(): string;

    public function getDateCreated(): \DateTimeImmutable;

    public function getDateUpdated(): ?\DateTimeImmutable;
}
