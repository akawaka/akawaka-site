<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Gateway\UnpublishArticle;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'article.unpublish';
}
