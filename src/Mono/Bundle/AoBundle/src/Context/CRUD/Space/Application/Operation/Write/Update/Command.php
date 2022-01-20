<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Write\Update;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private ?string $url,
        private ?string $description,
    ) {
    }

    public function getId(): SpaceId
    {
        return new SpaceId($this->identifier);
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
