<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Create\Form;

use Doctrine\Common\Collections\ArrayCollection;

final class CreatePageDTO
{
    public function __construct(
        private string $name,
        private ?string $slug,
        private ArrayCollection $channels,
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

    public function getChannels(): array
    {
        return $this->channels->toArray();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'channels' => $this->getChannels(),
        ];
    }
}
