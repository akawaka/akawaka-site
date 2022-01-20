<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class Space implements SpaceInterface
{
    public function __construct(
        private SpaceId $id,
        private string $name,
        private ?string $url,
        private ?string $description,
    ) {
    }

    public function getId(): SpaceId
    {
        return $this->id;
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
}
