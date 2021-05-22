<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Update\Form;

use Doctrine\Common\Collections\ArrayCollection;

final class UpdatePageDTO
{
    public function __construct(
        private string $name,
        private string $slug,
        private ?string $content,
        private ArrayCollection $spaces,
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

    public function getSpaces(): array
    {
        return $this->spaces->toArray();
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
            'spaces' => $this->getSpaces(),
        ];
    }
}
