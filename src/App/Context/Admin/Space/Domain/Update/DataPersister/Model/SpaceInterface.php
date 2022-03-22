<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Update\DataPersister\Model;

use App\Shared\Domain\Identifier\SpaceId;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;
}
