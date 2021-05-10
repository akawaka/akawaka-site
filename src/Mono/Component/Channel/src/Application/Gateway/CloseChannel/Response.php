<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\CloseChannel;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private ChannelInterface $channel
    ) {
    }

    public function getChannel(): ChannelInterface
    {
        return $this->channel;
    }

    public function data(): array
    {
        return [];
    }
}
