<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\SendContact;

use Black\Component\Core\Application\Gateway\GatewayRequest;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $firstname;

    private string $lastname;

    private string $email;

    private ?string $phone = null;

    private string $message;

    private string $budget;

    private ?string $how = null;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'firstname',
            'lastname',
            'email',
            'message',
            'budget',
        ];

        $optionalFields = [
            'phone',
            'how',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        foreach ($optionalFields as $field) {
            if (true === isset($optionalFields[$field])) {
                $dto->{$field} = $accessor->getValue($data, "[$field]");
            }
        }

        return $dto;
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

    #[ArrayShape([
        'firstname' => "string",
        'lastname' => "string",
        'email' => "string",
        'phone' => "null|string",
        'message' => "string",
        'budget' => "string",
        'how' => "null|string"
    ])]
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
