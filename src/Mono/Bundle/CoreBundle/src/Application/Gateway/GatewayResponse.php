<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway;

interface GatewayResponse
{
    /**
     * @return array<string,string>
     */
    public function data(): array;
}
