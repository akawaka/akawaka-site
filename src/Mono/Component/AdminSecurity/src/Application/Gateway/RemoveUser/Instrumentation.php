<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\RemoveUser;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'user.remove';
}
