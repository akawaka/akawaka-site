<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\View\Factory;

use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
