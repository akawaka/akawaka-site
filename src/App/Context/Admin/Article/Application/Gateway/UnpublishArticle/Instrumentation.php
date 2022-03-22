<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Gateway\UnpublishArticle;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'article.unpublish';
}
