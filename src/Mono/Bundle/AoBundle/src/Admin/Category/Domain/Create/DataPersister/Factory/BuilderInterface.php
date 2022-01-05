<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\DataPersister\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
