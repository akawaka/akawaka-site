<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Channel\Context\Request;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestBasedChannelContext
{
    public function __construct(
        private HostnameChannelContext $hostnameContext,
        private RequestStack $stack,
    ) {
    }

    public function getChannel(): ChannelInterface
    {
        if (null === $request = $this->stack->getMasterRequest()) {
            throw new \UnexpectedValueException('You must have a request');
        }

        $channel = $this->hostnameContext->getChannel($request);

        if (null !== $channel) {
            return $channel;
        }

        throw new ChannelNotFoundException('unknown');
    }
}
