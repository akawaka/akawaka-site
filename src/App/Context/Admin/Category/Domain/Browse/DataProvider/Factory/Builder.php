<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Browse\DataProvider\Factory;

use App\Context\Admin\Category\Domain\Browse\DataProvider\Model\Category;
use App\Context\Admin\Category\Domain\Browse\DataProvider\Model\CategoryInterface;
use App\Shared\Domain\Identifier\CategoryId;
use App\Shared\Domain\ValueObject\Slug;

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
