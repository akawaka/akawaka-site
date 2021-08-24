<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindPasswordRecoveryByToken;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'user.find_password_recovery_by_id';
}
