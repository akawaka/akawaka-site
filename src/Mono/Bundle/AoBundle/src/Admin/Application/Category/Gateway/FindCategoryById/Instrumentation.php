<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\FindCategoryById;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'category.find_by_id';
}
