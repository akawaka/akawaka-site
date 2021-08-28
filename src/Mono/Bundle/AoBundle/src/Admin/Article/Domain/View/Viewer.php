<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Article\Domain\View\Exception\UnknownArticleException;
use Mono\Bundle\AoBundle\Admin\Article\Domain\View\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\View\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\View\Repository\ReaderInterface;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private BuilderInterface $builder,
    ) {
    }

    public function read(ArticleId $id): ArticleInterface
    {
        $result = $this->reader->get($id);

        if ([] === $result) {
            throw new UnknownArticleException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?ArticleInterface
    {
        $result = $this->reader->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownArticleException($slug->getValue());
        }

        return $this->builder::build($result);
    }

    public function readAll(): array
    {
        $collection = [];
        $results = $this->reader->getAll();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
