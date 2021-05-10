<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Repository;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;

interface UpdateChannel
{
    public function update(ChannelInterface $ChannelInterface): void;
}
