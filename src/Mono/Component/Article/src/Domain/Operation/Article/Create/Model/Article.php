<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create\Model;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Article implements ArticleInterface
{
    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private array $categories = [],
        private array $authors = [],
    ) {
        $this->creationDate = new \Safe\DateTimeImmutable();
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

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return $this->creationDate;
    }
}
