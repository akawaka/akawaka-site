<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Model\Category;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Model\CategoryInterface;

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
