<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorById;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\AuthorResponse;

final class Response implements GatewayResponse
{
    use AuthorResponse;
}
