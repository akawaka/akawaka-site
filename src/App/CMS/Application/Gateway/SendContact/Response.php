<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\SendContact;

use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct()
    {
    }

    public function data(): array
    {
        return [];
    }
}
