<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Update\Form;

final class UpdatePasswordDTO
{
    public function __construct(
        private string $newPassword,
    ) {
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function data(): array
    {
        return [
            'newPassword' => $this->getNewPassword(),
        ];
    }
}
