<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\UpdateSpace;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $identifier;

    private string $name;

    private ?string $description = null;

    private ?string $url = null;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'identifier',
            'name',
        ];

        $optionalFields = [
            'description',
            'url',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        foreach ($optionalFields as $field) {
            if (true === isset($data[$field])) {
                $dto->{$field} = $accessor->getValue($data, "[{$field}]");
            }
        }

        return $dto;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getIdentifier(),
            'name' => $this->getName(),
            'url' => $this->getUrl(),
            'description' => $this->getDescription(),
        ];
    }
}
