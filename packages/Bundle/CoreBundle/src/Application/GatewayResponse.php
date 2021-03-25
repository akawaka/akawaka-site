<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Application;

interface GatewayResponse
{
    public function data(): array;
}
