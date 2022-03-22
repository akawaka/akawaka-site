<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\FindAuthorBySlug;

use App\Context\Admin\Author\Application\Gateway\AuthorResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use AuthorResponse;
}
