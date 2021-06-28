<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Publish;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

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
