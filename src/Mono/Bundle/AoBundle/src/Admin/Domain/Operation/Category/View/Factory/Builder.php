<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Model\Category;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Model\CategoryInterface;

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
