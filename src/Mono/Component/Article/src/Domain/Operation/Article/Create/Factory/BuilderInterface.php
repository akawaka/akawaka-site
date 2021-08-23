<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create\Factory;

use Mono\Component\Article\Domain\Operation\Article\Create\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
