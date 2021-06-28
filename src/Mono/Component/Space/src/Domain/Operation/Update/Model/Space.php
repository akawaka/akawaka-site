<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Update\Model;

use Mono\Component\Space\Domain\Common\Enum\StatusEnum;
use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;

final class Space implements SpaceInterface
{
    private \Safe\DateTimeImmutable $lastUpdate;

    public function __construct(
        private SpaceId $id,
        private SpaceCode $code,
        private string $name,
        private ?string $url = null,
        private ?string $description = null,
    ) {
        $this->lastUpdate = new \Safe\DateTimeImmutable();
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLastUpdate(): \Safe\DateTimeImmutable
    {
        return $this->lastUpdate;
    }
}
