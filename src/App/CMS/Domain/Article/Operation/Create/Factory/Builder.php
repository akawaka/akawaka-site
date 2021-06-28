<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Create\Factory;

use App\CMS\Domain\Article\Operation\Create\Model\Article;
use Mono\Component\Article\Domain\Operation\Article\Create\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\Create\Model\ArticleInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $article = []): ArticleInterface
    {
        return new Article(
            $article['id'],
            $article['slug'],
            $article['name'],
            $article['categories'],
            $article['spaces'],
        );
    }
}
