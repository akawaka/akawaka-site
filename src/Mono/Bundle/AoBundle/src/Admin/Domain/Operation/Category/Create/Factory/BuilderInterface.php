<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Create\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
