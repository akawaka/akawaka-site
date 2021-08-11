<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Operation\Write\Remove;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

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
