<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;
}
