<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

interface SpaceInterface
{
    public function getId(): SpaceId;

    public function getName(): string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;
}
