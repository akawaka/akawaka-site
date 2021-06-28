<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\View;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Category\View\Exception\UnknownCategoryException;
use Mono\Component\Article\Domain\Operation\Category\View\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;
use Mono\Component\Article\Domain\Operation\Category\View\Repository\ReaderInterface;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private BuilderInterface $builder,
    ) {
    }

    public function read(CategoryId $id): CategoryInterface
    {
        $result = $this->reader->get($id);

        if ([] === $result) {
            throw new UnknownCategoryException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?CategoryInterface
    {
        $result = $this->reader->getBySlug($slug);

        if (null === $result) {
            throw new UnknownCategoryException($slug->getValue());
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
