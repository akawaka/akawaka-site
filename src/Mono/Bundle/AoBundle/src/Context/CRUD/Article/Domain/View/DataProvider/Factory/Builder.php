<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Model\Article;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

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
