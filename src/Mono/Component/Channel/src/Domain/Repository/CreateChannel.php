<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Repository;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;

interface CreateChannel
{
    public function insert(ChannelInterface $channel): void;

    public function nextIdentity(): ChannelId;
}
