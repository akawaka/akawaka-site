<?php

declare(strict_types=1);

namespace Black\Component\Page\Entity;

use Black\Component\Page\Enum\StatusEnum;
use Safe\DateTimeImmutable;

class Page implements PageInterface
{
    protected string $name;

    protected string $slug;

    protected string $content;

    protected string $status;

    protected \DateTimeImmutable $dateCreated;

    protected ?\DateTimeImmutable  $dateUpdated;

    public function __construct()
    {
        $this->status = StatusEnum::DRAFT;
        $this->dateCreated = new \DateTimeImmutable();
        $this->dateUpdated = null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDateCreated(): DateTimeImmutable
    {
        return new DateTimeImmutable(
            $this->dateCreated->format('Y-m-d H:i:s.u'),
            $this->dateCreated->getTimezone()
        );
    }

    public function getDateUpdated(): ?DateTimeImmutable
    {
        if (null !== $this->dateUpdated) {
            return new DateTimeImmutable(
                $this->dateUpdated->format('Y-m-d H:i:s.u'),
                $this->dateUpdated->getTimezone()
            );
        }

        return null;
    }

    public function publish(): void
    {
        $this->status = StatusEnum::PUBLISHED;
        $this->dateUpdated = new DateTimeImmutable();
    }

    public function unpublish(): void
    {
        $this->status = StatusEnum::DRAFT;
        $this->dateUpdated = new DateTimeImmutable();
    }
}
