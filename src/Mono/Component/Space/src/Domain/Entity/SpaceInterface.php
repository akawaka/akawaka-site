<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Entity;

use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\ValueObject\SpaceCode;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getName(): string;

    public function getCode(): SpaceCode;

    public function getUrl(): ?string;

    public function getDescription(): ?string;

    public function getStatus(): string;

    public function getCreationDate(): \DateTimeImmutable;

    public function getLastUpdate(): ?\DateTimeImmutable;
}
