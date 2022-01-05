<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $id;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'id',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getId(): string
    {
        return $this->id;
    }

    #[ArrayShape(['id' => 'string'])]
    public function data(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
