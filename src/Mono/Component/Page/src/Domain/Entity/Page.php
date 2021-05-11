<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Page\Domain\Enum\StatusEnum;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

abstract class Page implements PageInterface
{
    protected string $id;

    protected string $name;

    protected string $slug;

    protected string $status;

    protected ?string $content;

    protected \DateTimeImmutable $creationDate;

    protected ?\DateTimeImmutable $lastUpdate;

    public function __construct()
    {
        $this->status = StatusEnum::DRAFT;
        $this->creationDate = new \Safe\DateTimeImmutable();

        $this->content = null;
        $this->lastUpdate = null;
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

    public function update(
        string $name,
        PageSlug $slug,
        ArrayCollection $channels,
        ?string $content,
    ) {
        $this->name = $name;
        $this->slug = $slug->getValue();
        $this->content = $content;
        $this->channels = $channels;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
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
}
