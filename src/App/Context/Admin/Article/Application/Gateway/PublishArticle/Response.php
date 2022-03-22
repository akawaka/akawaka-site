<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Gateway\PublishArticle;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
