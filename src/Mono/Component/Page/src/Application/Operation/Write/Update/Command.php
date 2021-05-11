<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Update;

use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
        private ?string $content,
        private array $channels,
    ) {
    }

    public function getId(): PageId
    {
        return new PageId($this->identifier);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): PageSlug
    {
        return new PageSlug($this->slug);
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getChannels(): array
    {
        return $this->channels;
    }
}
