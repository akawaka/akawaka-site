<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\View\Factory;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\View\Model\Article;
use Mono\Component\Article\Domain\Operation\Article\View\Model\ArticleInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $article = []): ArticleInterface
    {
        return new Article(
            new ArticleId($article['id']),
            new Slug($article['slug']),
            $article['name'],
            \DateTimeImmutable::createFromFormat('Y-m-d', $article['creation_date']),
            null !== $article['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d', $article['last_update']) : null,
            $article['content'],
            $article['categories'],
        );
    }
}
