<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Theme\Space\Context\Request;

use App\Context\Admin\Space\Application\Gateway\FindSpaceByHostname;
use App\Context\Admin\Space\Application\Gateway\FindSpaceByHostname as AoFindSpaceByHostname;
use App\Context\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
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
            $response = ($this->hostnameGateway)(AoFindSpaceByHostname\Request::fromData([
                'hostname' => $request->getSchemeAndHttpHost(),
            ]));

            return $response->getSpace();
        } catch (GatewayException $exception) {
            return null;
        }
    }
}
