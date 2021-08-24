<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\CreateArticle;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $name;

    private ?string $slug;

    private array $categories;

    private array $authors;

    private array $spaces;

    private function __construct()
    {
        $this->slug = null;
        $this->categories = [];
        $this->authors = [];
        $this->spaces = [];
    }

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'name',
            'categories',
            'authors',
            'spaces',
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

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }

    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'categories' => $this->getCategories(),
            'authors' => $this->getAuthors(),
            'spaces' => $this->getSpaces(),
        ];
    }
}
