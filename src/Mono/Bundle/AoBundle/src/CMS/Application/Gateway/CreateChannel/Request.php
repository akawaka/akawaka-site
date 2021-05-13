<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Application\Gateway\CreateChannel;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $code;

    private string $name;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'code',
            'name',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    #[ArrayShape(['code' => 'string', 'name' => 'string'])]
    public function data(): array
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
        ];
    }
}
