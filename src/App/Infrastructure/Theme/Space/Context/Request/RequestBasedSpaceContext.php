<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme\Space\Context\Request;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\Exception\SpaceWasNotFound;
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
        $request = $this->stack->getMainRequest();

        if (null !== $request) {
            $space = $this->hostnameContext->getSpace($request);

            if (null !== $space) {
                return $space;
            }
        }

        throw new SpaceWasNotFound('unknown');
    }
}
