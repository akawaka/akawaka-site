<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Gateway\FindSpaceByHostname;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'space.find_by_hostname';
}
