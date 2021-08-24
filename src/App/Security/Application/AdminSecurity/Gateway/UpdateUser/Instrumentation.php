<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\UpdateUser;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'admin_security.update';
}
