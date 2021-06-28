<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\FindArticleBySlug;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'article.find_by_code';
}