<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Model\Category;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Model\CategoryInterface;

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
