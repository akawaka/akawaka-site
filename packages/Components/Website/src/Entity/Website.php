<?php

declare(strict_types=1);

namespace Black\Component\Website\Entity;

use Black\Component\Website\Enum\StatusEnum;

class Website implements WebsiteInterface
{
    protected string $identifier;

    protected string $name;

    protected ?string $url;

    protected ?string $description;

    protected string $status;

    protected \DateTimeImmutable $dateCreated;

    protected ?\DateTimeImmutable $dateUpdated;

    public function __construct()
    {
        $this->status = StatusEnum::DRAFT;
        $this->dateCreated = new \DateTimeImmutable();
        $this->dateUpdated = null;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->dateCreated;
    }

    public function getDateUpdated(): ?\DateTimeImmutable
    {
        return $this->dateUpdated;
    }

    public function publish()
    {
        $this->status = StatusEnum::PUBLISHED;
        $this->dateUpdated = new \DateTimeImmutable();
    }

    public function unpublish()
    {
        $this->status = StatusEnum::DRAFT;
        $this->dateUpdated = new \DateTimeImmutable();
    }
}
