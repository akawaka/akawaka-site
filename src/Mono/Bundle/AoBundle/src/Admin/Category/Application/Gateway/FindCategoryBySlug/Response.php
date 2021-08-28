<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\FindCategoryBySlug;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\CategoryResponse;

final class Response implements GatewayResponse
{
    use CategoryResponse;
}
