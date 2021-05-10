<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindByCode;

use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

final class Query
{
    public function __construct(
        private string $code
    ) {
    }

    public function getCode(): ChannelCode
    {
        return new ChannelCode($this->code);
    }
}
