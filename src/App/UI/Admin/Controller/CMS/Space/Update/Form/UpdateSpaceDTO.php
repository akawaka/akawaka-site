<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Space\Update\Form;

final class UpdateSpaceDTO
{
    public function __construct(
        private string $name,
        private ?string $description,
        private ?string $url,
        private ?string $theme,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'url' => $this->getUrl(),
            'theme' => $this->getTheme(),
        ];
    }
}
