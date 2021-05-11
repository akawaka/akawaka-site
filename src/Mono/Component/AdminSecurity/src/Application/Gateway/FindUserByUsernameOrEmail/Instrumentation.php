<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindUserByUsernameOrEmail;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'user.find_by_username_or_email';
}