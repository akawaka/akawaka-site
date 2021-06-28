<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\UpdatePage;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $identifier;

    private string $name;

    private string $slug;

    private array $spaces;

    private ?string $content = null;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'identifier',
            'name',
            'slug',
            'spaces',
        ];

        $optionalFields = [
            'content',
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getIdentifier(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
            'spaces' => $this->getSpaces(),
        ];
    }
}