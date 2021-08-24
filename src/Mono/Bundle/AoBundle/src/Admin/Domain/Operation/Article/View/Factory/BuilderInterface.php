<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
