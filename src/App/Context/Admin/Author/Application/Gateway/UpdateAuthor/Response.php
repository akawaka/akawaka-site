<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\UpdateAuthor;

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
