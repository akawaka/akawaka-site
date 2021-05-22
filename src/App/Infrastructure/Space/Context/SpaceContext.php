<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use App\Infrastructure\Space\Context\Request\RequestBasedSpaceContext;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Exception\SpaceNotFoundException;

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
        } catch (SpaceNotFoundException $exception) {
            $space = $this->requestContext->getSpace();
        }

        return $space;
    }
}
