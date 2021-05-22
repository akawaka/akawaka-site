<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Operation\Write\Close;

use Mono\Component\Space\Domain\Identifier\SpaceId;

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
