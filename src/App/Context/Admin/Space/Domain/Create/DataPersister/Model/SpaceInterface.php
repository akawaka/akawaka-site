<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Create\DataPersister\Model;

use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getCode(): Code;

    public function getName(): string;

    public function getStatus(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
