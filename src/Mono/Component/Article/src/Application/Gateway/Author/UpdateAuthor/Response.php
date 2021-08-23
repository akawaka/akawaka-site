<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\UpdateAuthor;

use Mono\Component\Core\Application\Gateway\GatewayResponse;

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
