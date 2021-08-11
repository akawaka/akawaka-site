<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\RemoveSpace;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'space.remove';
}
