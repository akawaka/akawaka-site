<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Update\Model;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getCode(): SpaceCode;

    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;

    public function getLastUpdate(): \Safe\DateTimeImmutable;
}
