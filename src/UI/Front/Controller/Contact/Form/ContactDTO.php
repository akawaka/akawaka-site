<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Contact\Form;

final class ContactDTO
{
    public function __construct(
        private string $firstname,
        private string $lastname,
        private string $email,
        private ?string $phone,
        private string $message,
        private string $budget,
        private ?string $how,
    ) {
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getBudget(): string
    {
        return $this->budget;
    }

    public function getHow(): ?string
    {
        return $this->how;
    }

    public function data(): array
    {
        return [
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'message' => $this->getMessage(),
            'budget' => $this->getBudget(),
            'how' => $this->getHow(),
        ];
    }
}
