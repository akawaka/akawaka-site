<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context;

use App\Infrastructure\Space\Context\Request\RequestBasedSpaceContext;
use Mono\Component\Space\Domain\Operation\View\Exception\UnknownSpaceException;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

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
        } catch (UnknownSpaceException $exception) {
            $space = $this->requestContext->getSpace();
        }

        return $space;
    }
}
