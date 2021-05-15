<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Channel\Context;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;

interface ChannelContextInterface
{
    public function getChannel(): ChannelInterface;
}
