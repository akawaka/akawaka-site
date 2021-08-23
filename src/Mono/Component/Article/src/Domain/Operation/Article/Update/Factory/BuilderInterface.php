<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Update\Factory;

use Mono\Component\Article\Domain\Operation\Article\Update\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
