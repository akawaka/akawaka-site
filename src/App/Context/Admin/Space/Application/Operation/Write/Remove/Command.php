<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Operation\Write\Remove;

use App\Shared\Domain\Identifier\SpaceId;

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
