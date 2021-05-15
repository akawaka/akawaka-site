<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Application\Operation\Write\UpdateChannel;

use Mono\Component\Channel\Domain\Identifier\ChannelId;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private ?string $url,
        private ?string $description,
        private ?string $theme,
    ) {
    }

    public function getId(): ChannelId
    {
        return new ChannelId($this->identifier);
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

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
