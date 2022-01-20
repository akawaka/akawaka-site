<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\UpdateCategory;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function getSuccess(): bool
    {
        return true;
    }

    public function data(): array
    {
        return [];
    }
}
