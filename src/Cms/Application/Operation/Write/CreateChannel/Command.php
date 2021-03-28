<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\CreateChannel;

use Black\Component\Channel\Domain\ValueObject\ChannelCode;

final class Command
{
    private string $code;

    private string $name;

    public function __construct(
        string $code,
        string $name,
    ) {
        $this->code = $code;
        $this->name = $name;
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
