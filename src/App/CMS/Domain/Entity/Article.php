<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mono\Component\Article\Domain\Entity\Article as BaseArticle;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Mono\Component\Space\Domain\Entity\SpaceInterface;

class Article extends BaseArticle
{
    protected Collection $spaces;

    public function __construct()
    {
        $this->spaces = new ArrayCollection();

        parent::__construct();
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

    public function getSpaces(): Collection
    {
        return $this->spaces;
    }
}
