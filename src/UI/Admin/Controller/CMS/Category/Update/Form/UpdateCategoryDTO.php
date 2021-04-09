<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Update\Form;

final class UpdateCategoryDTO
{
    public function __construct(
        private string $name,
        private ?string $slug
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
        ];
    }
}
