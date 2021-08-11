<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\UpdateArticle;

use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private bool $success
    ) {
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function data(): array
    {
        return [];
    }
}
