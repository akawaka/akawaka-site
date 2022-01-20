<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Read\FindByCode;

use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

final class Query
{
    public function __construct(
        private string $code
    ) {
    }

    public function getCode(): Code
    {
        return new Code($this->code);
    }
}
