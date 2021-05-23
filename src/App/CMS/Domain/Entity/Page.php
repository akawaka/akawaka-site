<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mono\Component\Page\Domain\Enum\StatusEnum;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

class Page implements PageInterface
{
    protected string $id;

    protected string $name;

    protected string $slug;

    protected string $status;

    protected ?string $content;

    protected \DateTimeImmutable $creationDate;

    protected ?\DateTimeImmutable $lastUpdate;

    public Collection $spaces;

    public function __construct()
    {
        $this->status = StatusEnum::DRAFT;
        $this->creationDate = new \Safe\DateTimeImmutable();
        $this->spaces = new ArrayCollection();

        $this->content = null;
        $this->lastUpdate = null;
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

    public function update(
        string $name,
        PageSlug $slug,
        ArrayCollection $spaces,
        ?string $content,
    ): void {
        $this->name = $name;
        $this->slug = $slug->getValue();
        $this->content = $content;
        $this->spaces = $spaces;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
    }

    public function getId(): PageId
    {
        return new PageId($this->id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): PageSlug
    {
        return new PageSlug($this->slug);
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

    public function getSpaces(): Collection
    {
        return $this->spaces;
    }
}
