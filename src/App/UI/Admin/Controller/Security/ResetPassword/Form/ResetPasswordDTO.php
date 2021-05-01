<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\ResetPassword\Form;

final class ResetPasswordDTO
{
    public function __construct(
        private string $email,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
        ];
    }
}
