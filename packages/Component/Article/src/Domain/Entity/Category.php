<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Entity;

use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

abstract class Category implements CategoryInterface
{
    protected string $id;

    protected string $name;

    protected string $slug;

    protected Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): CategoryId
    {
        return new CategoryId($this->id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug($this->slug);
    }

    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function update(
        string $name,
        Slug $slug
    ) {
        $this->name = $name;
        $this->slug = $slug->getValue();
    }

    public function addArticle(ArticleInterface $article): void
    {
        if (false === $this->containsArticle($article)) {
            $this->articles->add($article);
        }
    }

    public function removeArticle(ArticleInterface $article): void
    {
        if (true === $this->containsArticle($article)) {
            $this->articles->removeElement($article);
        }
    }

    public function containsArticle(ArticleInterface $article): bool
    {
        return true === $this->articles->contains($article);
    }
}
