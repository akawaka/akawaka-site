<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Application;

interface GatewayRequest
{
    public static function fromData(array $data = []): self;

    public function data(): array;
}
