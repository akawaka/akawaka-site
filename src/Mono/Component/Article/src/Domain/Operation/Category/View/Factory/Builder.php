<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\View\Factory;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Category\View\Model\Category;
use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $category = []): CategoryInterface
    {
        return new Category(
            new CategoryId($category['id']),
            new Slug($category['slug']),
            $category['name'],
        );
    }
}
