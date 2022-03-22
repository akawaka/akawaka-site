<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\View\DataProvider\Model;

use App\Shared\Domain\Identifier\CategoryId;
use App\Shared\Domain\ValueObject\Slug;

interface CategoryInterface
{
    public function getId(): CategoryId;

    public function getSlug(): Slug;

    public function getName(): string;
}
