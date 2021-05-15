<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Create\Form;

final class CreateChannelDTO
{
    public function __construct(
        private string $name,
        private string $code,
        private ?string $theme,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'code' => $this->getCode(),
            'theme' => $this->getTheme(),
        ];
    }
}
