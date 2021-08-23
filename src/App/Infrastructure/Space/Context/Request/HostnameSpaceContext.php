<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context\Request;

use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceByHostname;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;

final class HostnameSpaceContext implements RequestSpaceContextInterface
{
    public function __construct(
        private FindSpaceByHostname\Gateway $hostnameGateway,
    ) {
    }

    public function getSpace(Request $request): ?SpaceInterface
    {
        try {
            $response = ($this->hostnameGateway)(FindSpaceByHostname\Request::fromData([
                'hostname' => $request->getSchemeAndHttpHost(),
            ]));

            return $response->getSpace();
        } catch (GatewayException $exception) {
            return null;
        }
    }
}
