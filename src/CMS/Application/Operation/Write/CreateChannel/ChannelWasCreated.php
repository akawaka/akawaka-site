<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateChannel;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;

final class ChannelWasCreated implements BrowserNotificationInterface
{
    public function __construct(
        private ChannelInterface $channel
    ) {
    }

    public function getChannel(): ChannelInterface
    {
        return $this->channel;
    }

    public function asBrowserNotification(): NotificationContext
    {
        return new NotificationContext('channel.created', 'success');
    }
}
