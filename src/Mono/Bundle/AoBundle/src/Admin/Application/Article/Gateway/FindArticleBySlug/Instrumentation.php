<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticleBySlug;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'article.find_by_code';
}
