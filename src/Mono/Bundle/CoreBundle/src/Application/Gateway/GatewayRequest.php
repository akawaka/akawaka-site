<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Gateway;

interface GatewayRequest
{
    /**
     * @param array<string,string> $data
     */
    public static function fromData(array $data = []): self;

    /**
     * @return array<string,string>
     */
    public function data(): array;
}
