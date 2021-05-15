<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Channel\Context;

use Mono\Bundle\AoBundle\Infrastructure\Channel\Context\Request\RequestBasedChannelContext;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;

final class ChannelContext implements ChannelContextInterface
{
    public function __construct(
        private RequestBasedChannelContext $requestContext,
        private SingleChannelContext $singleChannelContext,
    ) {
    }

    public function getChannel(): ChannelInterface
    {
        try {
            $channel = $this->singleChannelContext->getChannel();
        } catch (ChannelNotFoundException $exception) {
            $channel = $this->requestContext->getChannel();
        }

        return $channel;
    }
}
