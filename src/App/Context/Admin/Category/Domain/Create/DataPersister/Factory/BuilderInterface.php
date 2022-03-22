<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Category\Domain\Create\DataPersister\Model\CategoryInterface;

interface BuilderInterface
{
    public static function build(array $category = []): CategoryInterface;
}
