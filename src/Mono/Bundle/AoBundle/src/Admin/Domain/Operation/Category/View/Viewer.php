<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Exception\UnknownCategoryException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Repository\ReaderInterface;

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

        if ([] === $result) {
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
