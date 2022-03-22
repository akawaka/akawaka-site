<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Theme\Space\Model;

use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;

interface ThemeSpace
{
    public function getId(): SpaceId;

    public function getCode(): Code;

    public function getName(): string;

    public function getTheme(): ?string;

    public function getUrl(): ?string;

    public function getDescription(): ?string;
}
