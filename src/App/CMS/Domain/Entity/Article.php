<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Enum\StatusEnum;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Mono\Component\Space\Domain\Entity\SpaceInterface;

class Article implements ArticleInterface
{
    protected string $id;

    protected string $name;

    protected string $slug;

    protected string $status;

    protected ?string $content;

    protected Collection $categories;

    protected \DateTimeImmutable $creationDate;

    protected ?\DateTimeImmutable $lastUpdate;

    protected Collection $spaces;

    public function __construct()
    {
        $this->status = StatusEnum::DRAFT;
        $this->creationDate = new \Safe\DateTimeImmutable();
        $this->categories = new ArrayCollection();
        $this->spaces = new ArrayCollection();

        $this->content = null;
        $this->lastUpdate = null;
    }

    public static function create(
        ArticleId $id,
        Slug $slug,
        string $name,
        ArrayCollection $categories,
        ArrayCollection $spaces,
    ): ArticleInterface {
        $article = new self();
        $article->id = $id->getValue();
        $article->slug = $slug->getValue();
        $article->name = $name;
        $article->categories = $categories;
        $article->spaces = $spaces;

        return $article;
    }

    public function update(
        string $name,
        Slug $slug,
        ?string $content,
        Collection $categories,
        Collection $spaces,
    ): void {
        $this->name = $name;
        $this->slug = $slug->getValue();
        $this->content = $content;
        $this->categories = $categories;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
        $this->spaces = $spaces;
    }

    public function publish(): void
    {
        $this->status = StatusEnum::PUBLISHED;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
    }

    public function unpublish(): void
    {
        $this->status = StatusEnum::DRAFT;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
    }

    public function addSpace(SpaceInterface $space): void
    {
        if (false === $this->containsSpace($space)) {
            $this->spaces->add($space);
        }
    }

    public function removeSpace(SpaceInterface $space): void
    {
        if (true === $this->containsSpace($space)) {
            $this->spaces->removeElement($space);
        }
    }

    public function containsSpace(SpaceInterface $space): bool
    {
        return $this->spaces->contains($space);
    }

    public function getId(): ArticleId
    {
        return new ArticleId($this->id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug($this->slug);
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getContent(): ?string
    {
        return $this->content;
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
        if (null !== $this->lastUpdate) {
            return \Safe\DateTimeImmutable::createFromRegular($this->lastUpdate);
        }

        return null;
    }

    public function getSpaces(): Collection
    {
        return $this->spaces;
    }
}
