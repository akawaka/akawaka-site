<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context\Request;

use App\CMS\Application\Space\Gateway\FindSpaceByHostname;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

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
