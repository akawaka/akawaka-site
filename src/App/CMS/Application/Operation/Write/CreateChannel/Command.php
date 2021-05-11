<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateChannel;

use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

final class Command
{
    public function __construct(
        private string $code,
        private string $name,
    ) {
    }

    public function getCode(): ChannelCode
    {
        return new ChannelCode($this->code);
    }

    public function getName(): string
    {
        return $this->name;
    }
}