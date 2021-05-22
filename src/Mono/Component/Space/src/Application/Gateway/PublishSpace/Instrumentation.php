<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Gateway\PublishSpace;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'space.publish';
}
