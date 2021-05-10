<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Repository;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;

interface RemoveChannel
{
    public function remove(ChannelInterface $channel): void;
}
