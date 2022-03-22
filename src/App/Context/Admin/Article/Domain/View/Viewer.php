<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\View;

use App\Context\Admin\Article\Domain\View\DataProvider\Factory\BuilderInterface;
use App\Context\Admin\Article\Domain\View\DataProvider\Model\ArticleInterface;
use App\Context\Admin\Article\Domain\View\DataProvider\ViewProviderInterface;
use App\Context\Admin\Article\Domain\View\Exception\UnknownArticleException;
use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

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
