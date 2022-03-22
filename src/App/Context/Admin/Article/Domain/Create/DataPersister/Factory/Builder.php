<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Article\Domain\Create\DataPersister\Model\Article;
use App\Context\Admin\Article\Domain\Create\DataPersister\Model\ArticleInterface;

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
