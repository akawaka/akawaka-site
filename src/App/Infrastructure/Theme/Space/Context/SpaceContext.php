<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme\Space\Context;

use App\Infrastructure\Theme\Space\Context\Request\RequestBasedSpaceContext;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\Exception\SpaceWasNotFound;

final class SpaceContext implements SpaceContextInterface
{
    public function __construct(
        private RequestBasedSpaceContext $requestContext,
        private SingleSpaceContext $singleSpaceContext,
    ) {
    }

    public function getSpace(): SpaceInterface
    {
        try {
            $space = $this->singleSpaceContext->getSpace();
        } catch (SpaceWasNotFound $exception) {
            $space = $this->requestContext->getSpace();
        }

        return $space;
    }
}
