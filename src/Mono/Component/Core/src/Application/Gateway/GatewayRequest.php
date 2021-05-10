<?php

declare(strict_types=1);

namespace Mono\Component\Core\Application\Gateway;

interface GatewayRequest
{
    public static function fromData(array $data = []): self;

    public function data(): array;
}
