<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Domain\Entity;

use Mono\Component\Channel\Domain\Entity\Channel as BaseChannel;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

class Channel extends BaseChannel
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
