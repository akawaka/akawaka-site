<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\CreateChannel;

use Black\Component\Channel\Domain\Entity\ChannelInterface;

final class ChannelWasCreated
{
    private ChannelInterface $channel;

    public function __construct(ChannelInterface $channel)
    {
        $this->channel = $channel;
    }

    public function getChannel(): ChannelInterface
    {
        return $this->channel;
    }
}
