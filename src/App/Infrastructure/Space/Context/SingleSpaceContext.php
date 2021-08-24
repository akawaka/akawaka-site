<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaces;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Exception\SpaceWasNotFound;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model\SpaceInterface;

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
            throw new SpaceWasNotFound('unknown');
        }

        return $response->getSpaces()->first();
    }
}
