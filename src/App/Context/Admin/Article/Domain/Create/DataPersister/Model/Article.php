<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create\DataPersister\Model;

use App\Shared\Domain\Enum\ArticleStatus;
use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

final class Article implements ArticleInterface
{
    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private array $categories,
        private array $authors,
        private array $spaces,
        private string $status = ArticleStatus::DRAFT,
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return $this->creationDate;
    }
}
