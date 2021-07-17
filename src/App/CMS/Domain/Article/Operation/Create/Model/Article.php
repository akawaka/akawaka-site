<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Create\Model;

use App\CMS\Domain\Article\Common\Enum\StatusEnum;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\Create\Model\ArticleInterface;

final class Article implements ArticleInterface
{
    private string $status;

    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private array $categories,
        private array $spaces,
    ) {
        $this->status = StatusEnum::DRAFT;
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
