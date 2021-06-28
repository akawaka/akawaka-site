<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Update;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private ?string $url,
        private ?string $description,
        private ?string $theme,
    ) {
    }

    public function getId(): SpaceId
    {
        return new SpaceId($this->identifier);
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
