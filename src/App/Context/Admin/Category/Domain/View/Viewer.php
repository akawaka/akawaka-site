<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\View;

use App\Context\Admin\Category\Domain\View\DataProvider\Factory\BuilderInterface;
use App\Context\Admin\Category\Domain\View\DataProvider\Model\CategoryInterface;
use App\Context\Admin\Category\Domain\View\DataProvider\ViewProviderInterface;
use App\Context\Admin\Category\Domain\View\Exception\UnknownCategoryException;
use App\Shared\Domain\Identifier\CategoryId;
use App\Shared\Domain\ValueObject\Slug;

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
