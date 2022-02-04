<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse\DataProvider\Model\Category;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse\DataProvider\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

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
