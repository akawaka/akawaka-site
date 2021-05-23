<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindCategories;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.find_all';
}
