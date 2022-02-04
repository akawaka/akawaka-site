<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Browse\DataProvider\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

final class Article implements ArticleInterface
{
    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private string $status,
        private ArrayCollection $categories,
        private ArrayCollection $authors,
        private ArrayCollection $spaces,
        private \DateTimeImmutable $creationDate,
        private ?\DateTimeImmutable $lastUpdate,
        private ?string $content = null,
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

    public function getSpaces(): ArrayCollection
    {
        return $this->spaces;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }

    public function getStatus(): string
    {
        return $this->status;
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
}
