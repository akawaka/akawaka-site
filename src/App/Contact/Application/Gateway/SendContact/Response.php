<?php

declare(strict_types=1);

namespace App\Contact\Application\Gateway\SendContact;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
