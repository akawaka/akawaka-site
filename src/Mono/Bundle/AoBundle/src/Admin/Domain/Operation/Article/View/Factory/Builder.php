<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Model\Article;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Model\ArticleInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $article = []): ArticleInterface
    {
        return new Article(
            new ArticleId($article['id']),
            new Slug($article['slug']),
            $article['name'],
            $article['status'],
            new ArrayCollection($article['categories']),
            new ArrayCollection($article['authors']),
            new ArrayCollection($article['spaces']),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $article['creation_date']),
            null !== $article['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $article['last_update']) : null,
            $article['content'],
        );
    }
}
