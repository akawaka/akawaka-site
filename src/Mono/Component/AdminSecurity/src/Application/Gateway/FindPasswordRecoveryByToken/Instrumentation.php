<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindPasswordRecoveryByToken;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'user.find_password_recovery_by_id';
}
