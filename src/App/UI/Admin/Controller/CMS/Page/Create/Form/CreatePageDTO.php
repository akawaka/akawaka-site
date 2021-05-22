<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Create\Form;

use Doctrine\Common\Collections\ArrayCollection;

final class CreatePageDTO
{
    public function __construct(
        private string $name,
        private ?string $slug,
        private ArrayCollection $spaces,
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

    public function getSpaces(): array
    {
        return $this->spaces->toArray();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'spaces' => $this->getSpaces(),
        ];
    }
}
