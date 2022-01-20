<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Update\DataPersister\Model\Article;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Update\DataPersister\Model\ArticleInterface;

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
