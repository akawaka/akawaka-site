<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\UpdateChannel;

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
        $channel = $this->getChannel();

        return [
            'identifier' => $channel->getId()->getValue(),
            'code' => $channel->getCode()->getValue(),
            'name' => $channel->getName(),
            'url' => $channel->getUrl(),
            'description' => $channel->getDescription(),
            'status' => $channel->getStatus(),
            'creationDate' => $channel->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $channel->getLastUpdate() ? $channel->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
