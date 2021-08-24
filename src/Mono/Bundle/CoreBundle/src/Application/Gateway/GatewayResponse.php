<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway;

interface GatewayResponse
{
    public function data(): array;
}
