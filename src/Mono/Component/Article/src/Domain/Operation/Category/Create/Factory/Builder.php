<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Create\Factory;

use Mono\Component\Article\Domain\Operation\Category\Create\Model\Category;
use Mono\Component\Article\Domain\Operation\Category\Create\Model\CategoryInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $category = []): CategoryInterface
    {
        return new Category(
            $category['id'],
            $category['slug'],
            $category['name'],
        );
    }
}
