<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\View;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\View\Exception\UnknownArticleException;
use Mono\Component\Article\Domain\Operation\Article\View\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\View\Model\ArticleInterface;
use Mono\Component\Article\Domain\Operation\Article\View\Repository\ReaderInterface;

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

        if (null === $result) {
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
