<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use App\Infrastructure\Space\Context\Request\RequestBasedSpaceContext;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Exception\SpaceWasNotFound;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model\SpaceInterface;

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
