<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Update\Form;

final class UpdatePageDTO
{
    public function __construct(
        private string $name,
        private string $slug,
        private ?string $content
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
        ];
    }
}
