<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateArticle;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
        private ?string $content,
        private array $categories,
        private array $channels,
    ) {
    }

    public function getArticleId(): ArticleId
    {
        return new ArticleId($this->identifier);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug($this->slug);
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCategories(): ArrayCollection
    {
        return new ArrayCollection($this->categories);
    }

    public function getChannels(): array
    {
        return $this->channels;
    }
}
