<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\Exception\UnknownArticleException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function read(ArticleId $id): ArticleInterface
    {
        $result = $this->provider->get($id);

        if ([] === $result) {
            throw new UnknownArticleException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?ArticleInterface
    {
        $result = $this->provider->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownArticleException($slug->getValue());
        }

        return $this->builder::build($result);
    }
}
