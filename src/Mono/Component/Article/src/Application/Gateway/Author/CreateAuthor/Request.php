<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\CreateAuthor;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $name;

    private ?string $slug;

    private function __construct()
    {
        $this->slug = null;
    }

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'name',
        ];

        $optionalFields = [
            'slug',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        foreach ($optionalFields as $field) {
            if (true === isset($data[$field])) {
                $dto->{$field} = $accessor->getValue($data, "[{$field}]");
            }
        }

        return $dto;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
        ];
    }
}
