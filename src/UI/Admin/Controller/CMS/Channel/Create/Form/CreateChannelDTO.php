<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Create\Form;

final class CreateChannelDTO
{
    public function __construct(
        private string $name,
        private string $code,
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

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'code' => $this->getCode(),
        ];
    }
}
