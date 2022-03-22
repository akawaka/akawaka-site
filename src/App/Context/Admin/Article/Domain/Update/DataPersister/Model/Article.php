<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update\DataPersister\Model;

use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

final class Article implements ArticleInterface
{
    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private ?string $content,
        private array $categories = [],
        private array $authors = [],
        private array $spaces = [],
    ) {
    }

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
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
}
