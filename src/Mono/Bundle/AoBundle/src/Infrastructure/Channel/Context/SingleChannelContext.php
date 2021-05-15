<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Channel\Context;

use Mono\Component\Channel\Application\Gateway\FindChannels;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;

final class SingleChannelContext
{
    public function __construct(
        private FindChannels\Gateway $channelsGateway,
    ) {
    }

    public function getChannel(): ChannelInterface
    {
        $response = ($this->channelsGateway)(FindChannels\Request::fromData());

        if (1 !== $response->getChannels()->count()) {
            throw new ChannelNotFoundException('unknown');
        }

        return $response->getChannels()->first();
    }
}
