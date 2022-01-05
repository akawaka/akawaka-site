<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context\Request;

use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\Exception\SpaceWasNotFound;
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

        throw new SpaceWasNotFound('unknown');
    }
}
