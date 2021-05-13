<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Context;

use Mono\Component\Channel\Application\Gateway\FindChannels;
use Mono\Component\Channel\Application\Gateway\FindChannelByHostname;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;

final class ChannelContext
{
    public function __construct(
        private FindChannels\Gateway $channelsGateway,
        private FindChannelByHostname\Gateway $hostnameGateway,
    ) {

    }

    public function getChannel(Request $request): ChannelInterface
    {
        $response = ($this->channelsGateway)(FindChannels\Request::fromData());

        if (1 === $response->getChannels()->count()) {
            return $response->getChannels()->first();
        }

        try {
            $response = ($this->hostnameGateway)(FindChannelByHostname\Request::fromData([
                'hostname' => $request->getHost(),
            ]));

            return $response->getChannel();
        } catch (GatewayException $exception) {
            throw new ChannelNotFoundException($request->getHost());
        }
    }
}
