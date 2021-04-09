<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Doctrine\Common\Collections\ArrayCollection;

final class Command
{
    public function __construct(
        private ArticleInterface $article,
        private string $name,
        private string $slug,
        private ?string $content,
        private array $categories,
    ) {
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
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
}
