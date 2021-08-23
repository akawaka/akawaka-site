<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Update\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Article implements ArticleInterface
{
    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private ?string $content,
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

    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }
}
