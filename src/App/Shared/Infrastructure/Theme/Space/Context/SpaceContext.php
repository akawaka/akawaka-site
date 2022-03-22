<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Theme\Space\Context;

use App\Shared\Infrastructure\Theme\Space\Context\Request\RequestBasedSpaceContext;
use App\Shared\Infrastructure\Theme\Space\Exception\NoSpacesFound;
use App\Shared\Infrastructure\Theme\Space\Model\Space;
use App\Shared\Infrastructure\Theme\Space\Model\ThemeSpace;

final class SpaceContext implements SpaceContextInterface
{
    public function __construct(
        private RequestBasedSpaceContext $requestContext,
        private SingleSpaceContext $singleSpaceContext,
    ) {
    }

    public function getSpace(): ThemeSpace
    {
        try {
            $space = $this->singleSpaceContext->getSpace();
        } catch (NoSpacesFound $exception) {
            $space = $this->requestContext->getSpace();
        }

        return new Space(
            $space->getId(),
            $space->getCode(),
            $space->getName(),
            $space->getTheme(),
            $space->getUrl(),
            $space->getDescription()
        );
    }
}
