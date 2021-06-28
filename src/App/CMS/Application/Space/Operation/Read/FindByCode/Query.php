<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Read\FindByCode;

use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;

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
