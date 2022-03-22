<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Operation\Read\FindByCode;

use App\Shared\Domain\ValueObject\Code;

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
