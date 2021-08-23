<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\FindArticleBySlug;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Article\Application\Gateway\Article\ArticleResponse;

final class Response implements GatewayResponse
{
    use ArticleResponse;
}
