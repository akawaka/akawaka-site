<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\UpdateCategory;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.update';
}
