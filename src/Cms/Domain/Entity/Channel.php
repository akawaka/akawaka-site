<?php

declare(strict_types=1);

namespace App\Cms\Domain\Entity;

use Black\Component\Channel\Domain\Entity\Channel as BaseChannel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Channel\Domain\Identifier\ChannelId;
use Black\Component\Channel\Domain\ValueObject\ChannelCode;

final class Channel extends BaseChannel
{
    public static function create(
        ChannelId $id,
        ChannelCode $code,
        string $name,
    ): ChannelInterface {
        $channel = new self();
        $channel->id = $id->getValue();
        $channel->code = $code->getValue();
        $channel->name = $name;

        return $channel;
    }
}
