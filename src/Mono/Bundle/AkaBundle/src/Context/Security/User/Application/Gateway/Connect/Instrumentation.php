<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Application\Gateway\Connect;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'security.user.connect';
}
