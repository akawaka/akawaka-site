<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Factory;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Model\Article;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Model\ArticleInterface;

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
