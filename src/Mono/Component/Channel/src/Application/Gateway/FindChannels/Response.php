<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\FindChannels;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    private ArrayCollection $channels;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
    }

    public function addChannel(ChannelInterface $channel): void
    {
        $this->channels->add($channel);
    }

    public function getChannels(): ArrayCollection
    {
        return $this->channels;
    }

    public function data(): array
    {
        return $this->getChannels()->map(function (ChannelInterface $channel) {
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
        })->toArray();
    }
}
