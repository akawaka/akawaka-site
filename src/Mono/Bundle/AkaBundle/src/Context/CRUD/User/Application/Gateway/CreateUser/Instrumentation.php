<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\CreateUser;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'admin_user.create';

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
