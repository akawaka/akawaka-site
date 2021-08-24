<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Create\Model\CategoryInterface;

interface CreatorInterface
{
    public function create(CategoryInterface $category): void;
}
