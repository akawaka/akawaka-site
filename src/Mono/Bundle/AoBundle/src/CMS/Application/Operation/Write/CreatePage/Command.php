<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Application\Operation\Write\CreatePage;

use Mono\Component\Page\Domain\ValueObject\PageSlug;

final class Command
{
    public function __construct(
        private string $name,
        private ?string $slug,
        private array $channels,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): PageSlug
    {
        $slug = $this->slug;

        if (null === $slug) {
            $slug = $this->getName();
        }

        return new PageSlug($slug);
    }

    public function getChannels(): array
    {
        return $this->channels;
    }
}
