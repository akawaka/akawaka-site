<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\UpdatePassword;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $identifier;

    private string $password;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'identifier',
            'password',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    #[ArrayShape(['identifier' => 'string', 'password' => 'string'])]
    public function data(): array
    {
        return [
            'identifier' => $this->getIdentifier(),
            'password' => $this->getPassword(),
        ];
    }
}
