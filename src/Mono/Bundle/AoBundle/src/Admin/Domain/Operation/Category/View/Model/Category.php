<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

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
