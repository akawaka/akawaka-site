<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Browse\DataProvider\Factory;

use App\Context\Admin\Category\Domain\Browse\DataProvider\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
