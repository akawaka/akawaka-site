<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\RemoveUser;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $identifier;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'identifier',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    #[ArrayShape(['identifier' => 'string'])]
    public function data(): array
    {
        return [
            'identifier' => $this->getIdentifier(),
        ];
    }
}
