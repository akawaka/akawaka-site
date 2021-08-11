<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\View\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Article implements ArticleInterface
{
    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private \DateTimeImmutable $creationDate,
        private ?\DateTimeImmutable $lastUpdate,
        private ?string $content = null,
        private ArrayCollection $categories,
        private ArrayCollection $authors,
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

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return \Safe\DateTimeImmutable::createFromRegular($this->creationDate);
    }

    public function getLastUpdate(): ?\Safe\DateTimeImmutable
    {
        if (null === $this->lastUpdate) {
            return null;
        }

        return \Safe\DateTimeImmutable::createFromRegular($this->lastUpdate);
    }

    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }
}
