<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Create\Model;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Category implements CategoryInterface
{
    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private CategoryId $id,
        private Slug $slug,
        private string $name,
    ) {
        $this->creationDate = new \Safe\DateTimeImmutable();
    }

    public function getId(): CategoryId
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

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return $this->creationDate;
    }
}
