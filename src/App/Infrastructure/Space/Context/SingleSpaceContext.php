<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Component\Space\Application\Gateway\FindSpaces;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Exception\SpaceNotFoundException;

final class SingleSpaceContext
{
    public function __construct(
        private FindSpaces\Gateway $spacesGateway,
    ) {
    }

    public function getSpace(): SpaceInterface
    {
        $response = ($this->spacesGateway)(FindSpaces\Request::fromData());

        if (1 !== $response->getSpaces()->count()) {
            throw new SpaceNotFoundException('unknown');
        }

        return $response->getSpaces()->first();
    }
}
