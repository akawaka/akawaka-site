<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
    ) {
    }

    public function getSuccess(): bool
    {
        return true;
    }

    public function data(): array
    {
        return [];
    }
}
