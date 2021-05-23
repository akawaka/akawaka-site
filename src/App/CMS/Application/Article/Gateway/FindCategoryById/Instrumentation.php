<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindCategoryById;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.find_by_id';
}
