<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mono\Component\Page\Domain\Entity\Page as BasePage;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

class Page extends BasePage
{
    public Collection $spaces;

    public function __construct()
    {
        $this->spaces = new ArrayCollection();

        parent::__construct();
    }

    public static function create(
        PageId $id,
        PageSlug $slug,
        string $name,
        ArrayCollection $spaces,
    ): PageInterface {
        $page = new self();
        $page->id = $id->getValue();
        $page->slug = $slug->getValue();
        $page->name = $name;
        $page->spaces = $spaces;

        return $page;
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
