<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\ResetPassword\Form;

final class ResetPasswordDTO
{
    public function __construct(
        private string $usernameOrEmail,
    ) {
    }

    public function getUsernameOrEmail(): string
    {
        return $this->usernameOrEmail;
    }

    public function toArray(): array
    {
        return [
            'usernameOrEmail' => $this->getUsernameOrEmail(),
        ];
    }
}
