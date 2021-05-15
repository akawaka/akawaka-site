<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Repository;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;

interface FindChannelByHostname
{
    public function find(string $hostname): ?ChannelInterface;
}
