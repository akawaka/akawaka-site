<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Theme\Space\Model;

use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;

final class Space implements ThemeSpace
{
    public function __construct(
        private SpaceId $id,
        private Code $code,
        private string $name,
        private ?string $theme,
        private ?string $url,
        private ?string $description,
    ) {
    }

    public function getId(): SpaceId
    {
        return $this->id;
    }

    public function getCode(): Code
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
