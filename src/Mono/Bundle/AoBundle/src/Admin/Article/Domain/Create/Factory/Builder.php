<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Model\Article;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Model\ArticleInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $article = []): ArticleInterface
    {
        return new Article(
            $article['id'],
            $article['slug'],
            $article['name'],
            $article['categories'],
            $article['authors'],
            $article['spaces'],
        );
    }
}
