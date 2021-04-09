<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Create\Form;

final class RegisterDTO
{
    public function __construct(
        private string $username,
        private string $email,
        private string $password,
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }
}
