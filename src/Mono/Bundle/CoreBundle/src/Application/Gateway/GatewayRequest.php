<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway;

interface GatewayRequest
{
    public static function fromData(array $data = []): self;

    public function data(): array;
}
