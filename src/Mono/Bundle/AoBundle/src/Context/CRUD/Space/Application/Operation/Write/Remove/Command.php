<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Write\Remove;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): SpaceId
    {
        return new SpaceId($this->identifier);
    }
}
