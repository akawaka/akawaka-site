<?php

declare(strict_types=1);

namespace App\Infrastructure\Channel\Context\Request;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestChannelContextInterface
{
    public function getChannel(Request $request): ?ChannelInterface;
}
