<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\CreateChannel;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $code;

    private string $name;

    private ?string $theme = null;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'code',
            'name',
        ];

        $optionalFields = [
            'theme',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        foreach ($optionalFields as $field) {
            if (true === in_array($field, $optionalFields)) {
                $dto->{$field} = $accessor->getValue($data, "[{$field}]");
            }
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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function data(): array
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'theme' => $this->getTheme(),
        ];
    }
}
