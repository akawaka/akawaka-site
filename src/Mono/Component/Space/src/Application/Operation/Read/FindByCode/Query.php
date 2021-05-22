<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Operation\Read\FindByCode;

use Mono\Component\Space\Domain\ValueObject\SpaceCode;

final class Query
{
    public function __construct(
        private string $code
    ) {
    }

    public function getCode(): SpaceCode
    {
        return new SpaceCode($this->code);
    }
}
