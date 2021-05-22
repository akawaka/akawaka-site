<?php

declare(strict_types=1);

namespace App\Infrastructure\Channel\Context\Request;

use Mono\Component\Channel\Application\Gateway\FindChannelByHostname;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;

final class HostnameChannelContext implements RequestChannelContextInterface
{
    public function __construct(
        private FindChannelByHostname\Gateway $hostnameGateway,
    ) {
    }

    public function getChannel(Request $request): ?ChannelInterface
    {
        try {
            $response = ($this->hostnameGateway)(FindChannelByHostname\Request::fromData([
                'hostname' => $request->getHost(),
            ]));

            return $response->getChannel();
        } catch (GatewayException $exception) {
            return null;
        }
    }
}
