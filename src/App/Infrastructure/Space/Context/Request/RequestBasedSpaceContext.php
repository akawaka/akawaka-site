<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context\Request;

use Mono\Component\Space\Domain\Operation\View\Exception\UnknownSpaceException;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestBasedSpaceContext
{
    public function __construct(
        private HostnameSpaceContext $hostnameContext,
        private RequestStack $stack,
    ) {
    }

    public function getSpace(): SpaceInterface
    {
        $request = $this->stack->getMasterRequest();

        if (null !== $request) {
            $space = $this->hostnameContext->getSpace($request);

            if (null !== $space) {
                return $space;
            }
        }

        throw new UnknownSpaceException('unknown');
    }
}
