<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Mono\Component\Article\Domain\Entity\Category as BaseCategory;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\ValueObject\Slug;

final class Category extends BaseCategory
{
    public static function create(
        CategoryId $id,
        Slug $slug,
        string $name,
    ): CategoryInterface {
        $category = new self();
        $category->id = $id->getValue();
        $category->slug = $slug->getValue();
        $category->name = $name;

        return $category;
    }
}
