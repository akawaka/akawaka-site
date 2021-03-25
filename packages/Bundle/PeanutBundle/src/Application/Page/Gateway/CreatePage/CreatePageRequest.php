<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\CreatePage;

use Black\Bundle\CoreBundle\Application\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class CreatePageRequest implements GatewayRequest
{
    private string $name;

    private ?string $slug;

    private string $content;

    private function __construct()
    {
        $this->slug = null;
    }

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'name',
            'content',
        ];

        $optionalFields = [
            'slug',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        foreach ($optionalFields as $field) {
            if (null !== $accessor->getValue($data, "[$field]")) {
                $dto->{$field} = $accessor->getValue($data, "[$field]");
            }
        }

        return $dto;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
