<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\FindCategoryBySlug;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'category.find_by_code';
}
