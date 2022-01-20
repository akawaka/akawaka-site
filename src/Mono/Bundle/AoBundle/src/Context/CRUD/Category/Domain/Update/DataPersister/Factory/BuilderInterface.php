<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
