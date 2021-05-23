<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Create;

use Mono\Component\Space\Domain\ValueObject\SpaceCode;

final class Command
{
    public function __construct(
        private string $code,
        private string $name,
        private ?string $theme,
    ) {
    }

    public function getCode(): SpaceCode
    {
        return new SpaceCode($this->code);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
