<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Write\Remove;

use Mono\Component\Channel\Domain\Identifier\ChannelId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): ChannelId
    {
        return new ChannelId($this->identifier);
    }
}
