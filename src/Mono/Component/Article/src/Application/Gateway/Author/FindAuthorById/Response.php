<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\FindAuthorById;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Article\Application\Gateway\Author\AuthorResponse;

final class Response implements GatewayResponse
{
    use AuthorResponse;
}
