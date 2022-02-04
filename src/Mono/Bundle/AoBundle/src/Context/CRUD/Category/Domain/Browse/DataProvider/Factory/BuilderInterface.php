<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse\DataProvider\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
