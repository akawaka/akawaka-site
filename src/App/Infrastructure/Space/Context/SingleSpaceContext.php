<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaces;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\Exception\SpaceWasNotFound;

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
