<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\UpdatePage;

use Black\Bundle\CoreBundle\Application\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class UpdatePageRequest implements GatewayRequest
{
    private string $id;

    private string $name;

    private string $slug;

    private string $content;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'id',
            'name',
            'slug',
            'content',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        return $dto;
    }

    public function data(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
