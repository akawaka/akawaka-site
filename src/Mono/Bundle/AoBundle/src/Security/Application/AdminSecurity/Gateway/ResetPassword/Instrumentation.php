<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Gateway\ResetPassword;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'admin_security.recover_password';
}
