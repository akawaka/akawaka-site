<?php

declare(strict_types=1);

namespace Mono\Component\Core\Application\Gateway;

interface GatewayResponse
{
    public function data(): array;
}
