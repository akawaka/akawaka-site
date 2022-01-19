<?php

declare(strict_types=1);

namespace App\Admin\Space\Domain\Create\DataPersister\Model;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\SpaceStatus;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

final class Space implements SpaceInterface
{
    private string $status;

    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private SpaceId $id,
        private Code $code,
        private string $name,
        private ?string $theme,
    ) {
        $this->status = SpaceStatus::CLOSED;
        $this->creationDate = new \Safe\DateTimeImmutable();
    }

    public function getId(): SpaceId
    {
        return $this->id;
    }

    public function getCode(): Code
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
