<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\SendContact;

final class Command
{
    private string $firstname;

    private string $lastname;

    private string $email;

    private ?string $phone;

    private string $message;

    private string $budget;

    private ?string $how;

    public function __construct(
        string $firstname,
        string $lastname,
        string $email,
        ?string $phone,
        string $message,
        string $budget,
        ?string $how,
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->budget = $budget;
        $this->how = $how;
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
}
