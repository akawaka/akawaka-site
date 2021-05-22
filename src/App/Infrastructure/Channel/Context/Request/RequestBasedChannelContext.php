<?php

declare(strict_types=1);

namespace App\Infrastructure\Channel\Context\Request;

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
        $request = $this->stack->getMasterRequest();

        if (null !== $request) {
            $channel = $this->hostnameContext->getChannel($request);

            if (null !== $channel) {
                return $channel;
            }
        }

        throw new ChannelNotFoundException('unknown');
    }
}
