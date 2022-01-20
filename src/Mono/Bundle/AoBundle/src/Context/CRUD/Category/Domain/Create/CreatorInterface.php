<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister\Model\CategoryInterface;

interface CreatorInterface
{
    public function create(CategoryInterface $category): void;
}
