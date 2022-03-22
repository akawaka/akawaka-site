<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Update\DataPersister\Factory;

use App\Context\Admin\Category\Domain\Update\DataPersister\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
