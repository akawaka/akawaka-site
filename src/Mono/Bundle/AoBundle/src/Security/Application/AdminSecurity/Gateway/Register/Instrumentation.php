<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Gateway\Register;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'admin_security.register';

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
