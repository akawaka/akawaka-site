<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\FindCategoryBySlug;

use App\Context\Admin\Category\Application\Gateway\CategoryResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use CategoryResponse;
}
