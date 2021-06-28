<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Create\Model;

use App\CMS\Domain\Space\Common\Enum\StatusEnum;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Common\ValueObject\SpaceCode;

final class Space implements SpaceInterface
{
    private string $status;

    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private SpaceId $id,
        private SpaceCode $code,
        private string $name,
        private ?string $theme,
    ) {
        $this->status = StatusEnum::CLOSED;
        $this->creationDate = new \Safe\DateTimeImmutable();
    }

    public function getId(): SpaceId
    {
        return $this->id;
    }

    public function getCode(): SpaceCode
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return $this->creationDate;
    }
}
