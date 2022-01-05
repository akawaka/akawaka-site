<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\View\DataProvider\Factory;

use Mono\Bundle\AoBundle\Admin\Category\Domain\View\DataProvider\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
