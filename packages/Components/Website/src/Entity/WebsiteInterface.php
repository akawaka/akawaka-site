<?php

declare(strict_types=1);

namespace Black\Component\Website\Entity;

interface WebsiteInterface
{
    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;

    public function getStatus(): string;

    public function getDateCreated(): \DateTimeImmutable;

    public function getDateUpdated(): ?\DateTimeImmutable;
}
