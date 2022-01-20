<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\FindCategoryById;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\CategoryResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use CategoryResponse;
}
