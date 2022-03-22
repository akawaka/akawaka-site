<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\BrowseCategories;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'category.browse';
}
