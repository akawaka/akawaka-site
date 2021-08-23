<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Article\Operation\Update\Factory;

use Mono\Bundle\AoBundle\Domain\Article\Operation\Update\Model\Article;
use Mono\Component\Article\Domain\Operation\Article\Update\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\Update\Model\ArticleInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $article = []): ArticleInterface
    {
        return new Article(
            $article['id'],
            $article['slug'],
            $article['name'],
            $article['content'],
            $article['categories'],
            $article['authors'],
            $article['spaces'],
        );
    }
}
