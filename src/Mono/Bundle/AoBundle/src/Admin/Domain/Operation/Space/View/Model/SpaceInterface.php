<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Code;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getCode(): Code;

    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;

    public function getStatus(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}
