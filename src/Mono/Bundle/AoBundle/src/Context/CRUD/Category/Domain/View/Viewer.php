<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View\DataProvider\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View\Exception\UnknownCategoryException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function read(CategoryId $id): CategoryInterface
    {
        $result = $this->provider->get($id);

        if ([] === $result) {
            throw new UnknownCategoryException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?CategoryInterface
    {
        $result = $this->provider->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownCategoryException($slug->getValue());
        }

        return $this->builder::build($result);
    }
}
