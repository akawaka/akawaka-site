<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindCategoryBySlug;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.find_by_code';
}
