<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\RemoveCategory;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.remove';
}
