<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Entity;

use Mono\Component\Channel\Domain\Enum\StatusEnum;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

class Channel implements ChannelInterface
{
    protected string $id;

    protected string $code;

    protected string $name;

    protected ?string $url;

    protected ?string $description;

    protected string $status;

    protected \DateTimeImmutable $creationDate;

    protected ?\DateTimeImmutable $lastUpdate;

    public function __construct()
    {
        $this->status = StatusEnum::CLOSED;
        $this->creationDate = new \Safe\DateTimeImmutable();

        $this->url = null;
        $this->description = null;
        $this->lastUpdate = null;
    }

    public function getId(): ChannelId
    {
        return new ChannelId($this->id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): ChannelCode
    {
        return new ChannelCode($this->code);
    }

    public function update(
        string $name,
        ?string $url,
        ?string $description,
    ): void {
        $this->name = $name;
        $this->url = $url;
        $this->description = $description;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
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

    public function close(): void
    {
        $this->status = StatusEnum::CLOSED;
        $this->lastUpdate = new \Safe\DateTimeImmutable();
    }
}
