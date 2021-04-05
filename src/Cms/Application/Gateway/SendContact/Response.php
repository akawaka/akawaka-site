<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\SendContact;

use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Core\Application\Gateway\GatewayResponse;

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
