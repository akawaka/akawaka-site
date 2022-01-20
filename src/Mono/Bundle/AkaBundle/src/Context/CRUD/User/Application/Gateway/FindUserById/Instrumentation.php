<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUserById;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'user.find_by_id';
}
