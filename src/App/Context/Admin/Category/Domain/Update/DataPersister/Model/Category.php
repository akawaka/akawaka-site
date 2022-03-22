<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Update\DataPersister\Model;

use App\Shared\Domain\Identifier\CategoryId;
use App\Shared\Domain\ValueObject\Slug;

final class Category implements CategoryInterface
{
    public function __construct(
        private CategoryId $id,
        private Slug $slug,
        private string $name,
    ) {
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
