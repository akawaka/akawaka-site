<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Update\Form;

final class UpdateChannelDTO
{
    public function __construct(
        private string $name,
        private ?string $description,
        private ?string $url
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

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'url' => $this->getUrl(),
        ];
    }
}