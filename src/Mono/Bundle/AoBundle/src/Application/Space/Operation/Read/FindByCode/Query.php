<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Operation\Read\FindByCode;

use Mono\Bundle\AoBundle\Domain\Space\Common\ValueObject\SpaceCode;

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
