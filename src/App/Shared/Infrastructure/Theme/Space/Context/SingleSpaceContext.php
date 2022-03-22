<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Theme\Space\Context;

use App\Context\Admin\Space\Application\Gateway\BrowseSpaces\Gateway;
use App\Shared\Infrastructure\Theme\Space\Exception\NoSpacesFound;
use App\Context\Admin\Space\Application\Gateway\BrowseSpaces\Request;
use App\Context\Admin\Space\Domain\Browse\DataProvider\Model\SpaceInterface;

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
            throw new NoSpacesFound();
        }

        return $response->getSpaces()->first();
    }
}
