<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\FindAuthorById;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\AuthorResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use AuthorResponse;
}
