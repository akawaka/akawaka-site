<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Update\Model\CategoryInterface;

interface UpdaterInterface
{
    public function update(CategoryInterface $category): void;
}
