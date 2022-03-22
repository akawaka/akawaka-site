<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Category\Domain\Create\DataPersister\Model\Category;
use App\Context\Admin\Category\Domain\Create\DataPersister\Model\CategoryInterface;

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
