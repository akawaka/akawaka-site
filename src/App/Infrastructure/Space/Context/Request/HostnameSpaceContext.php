<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context\Request;

use Mono\Component\Space\Application\Gateway\FindSpaceByHostname;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;

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
                'hostname' => $request->getHost(),
            ]));

            return $response->getSpace();
        } catch (GatewayException $exception) {
            return null;
        }
    }
}
