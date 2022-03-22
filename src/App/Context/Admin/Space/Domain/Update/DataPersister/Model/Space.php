<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Update\DataPersister\Model;

use App\Shared\Domain\Identifier\SpaceId;

final class Space implements SpaceInterface
{
    public function __construct(
        private SpaceId $id,
        private string $name,
        private ?string $url,
        private ?string $description,
        private ?string $theme,
    ) {
    }

    public function getId(): SpaceId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
