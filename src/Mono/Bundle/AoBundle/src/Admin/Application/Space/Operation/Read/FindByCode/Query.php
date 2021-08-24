<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Read\FindByCode;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Code;

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
