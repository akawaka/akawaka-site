<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\GeneratePassword;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'security.password_recovery.generate_password';

    public function start(GatewayRequest $request): void
    {
        unset($request->data()['password']);
        parent::start($request);
    }

    public function error(GatewayRequest $request, string $reason): void
    {
        unset($request->data()['password']);
        parent::error($request, $reason);
    }
}
