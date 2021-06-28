<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Remove;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

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
