<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme\Space\Context;

use App\Context\Admin\Space\Application\Gateway\FindSpaces\Gateway;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaces\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\Exception\SpaceWasNotFound;

final class SingleSpaceContext
{
    public function __construct(
        private Gateway $spacesGateway,
    ) {
    }

    public function getSpace(): SpaceInterface
    {
        $response = ($this->spacesGateway)(Request::fromData());

        if (1 !== $response->getSpaces()->count()) {
            throw new SpaceWasNotFound('unknown');
        }

        return $response->getSpaces()->first();
    }
}
