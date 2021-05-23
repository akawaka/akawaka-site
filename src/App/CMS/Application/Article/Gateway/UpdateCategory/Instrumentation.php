<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\UpdateCategory;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.update';
}
