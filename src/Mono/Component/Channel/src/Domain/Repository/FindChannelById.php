<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Repository;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;

interface FindChannelById
{
    public function find(ChannelId $id): ?ChannelInterface;
}
