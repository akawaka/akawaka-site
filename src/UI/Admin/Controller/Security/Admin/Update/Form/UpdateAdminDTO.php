<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Update\Form;

final class UpdateAdminDTO
{
    public function __construct(
        private string $username,
        private string $email,
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function data(): array
    {
        return [
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
        ];
    }
}
