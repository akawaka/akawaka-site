<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Common\ValueObject\SpaceCode;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getCode(): SpaceCode;

    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;

    public function getStatus(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}
