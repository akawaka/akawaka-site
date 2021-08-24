<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorBySlug;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\AuthorResponse;

final class Response implements GatewayResponse
{
    use AuthorResponse;
}
