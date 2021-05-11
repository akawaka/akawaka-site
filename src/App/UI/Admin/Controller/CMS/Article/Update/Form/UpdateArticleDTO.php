<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Update\Form;

use Doctrine\Common\Collections\ArrayCollection;

final class UpdateArticleDTO
{
    public function __construct(
        private string $name,
        private string $slug,
        private ?string $content,
        private ArrayCollection $categories,
        private ArrayCollection $channels,
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

    public function getChannels(): array
    {
        return $this->channels->toArray();
    }

    public function getCategories(): array
    {
        return $this->categories->toArray();
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
            'channels' => $this->getChannels(),
            'categories' => $this->getCategories(),
        ];
    }
}
