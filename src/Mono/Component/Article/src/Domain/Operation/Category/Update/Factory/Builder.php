<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Update\Factory;

use Mono\Component\Article\Domain\Operation\Category\Update\Model\Category;
use Mono\Component\Article\Domain\Operation\Category\Update\Model\CategoryInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $category = []): CategoryInterface
    {
        return new Category(
            $category['id'],
            $category['slug'],
            $category['name'],
            $category['content'],
        );
    }
}
