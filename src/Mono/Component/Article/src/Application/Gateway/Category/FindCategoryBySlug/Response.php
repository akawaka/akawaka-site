<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\FindCategoryBySlug;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Article\Application\Gateway\Category\CategoryResponse;

final class Response implements GatewayResponse
{
    use CategoryResponse;
}
