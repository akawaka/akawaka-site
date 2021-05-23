<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Enum\StatusEnum;
use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\ValueObject\SpaceCode;

class Space implements SpaceInterface
{
    protected string $id;

    protected string $code;

    protected string $name;

    protected ?string $url;

    protected ?string $description;

    protected ?string $theme;

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
        $this->theme = null;
    }

    public static function create(
        SpaceId $id,
        SpaceCode $code,
        string $name,
        ?string $theme,
    ): SpaceInterface {
        $space = new self();
        $space->id = $id->getValue();
        $space->code = $code->getValue();
        $space->name = $name;
        $space->theme = $theme;

        return $space;
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

    public function updateTheme(
        ?string $theme
    ): void {
        $this->theme = $theme;
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

    public function getId(): SpaceId
    {
        return new SpaceId($this->id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): SpaceCode
    {
        return new SpaceCode($this->code);
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

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
