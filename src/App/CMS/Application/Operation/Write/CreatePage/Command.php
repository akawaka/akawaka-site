<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreatePage;

use Doctrine\Common\Collections\ArrayCollection;
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

    public function getChannels(): ArrayCollection
    {
        return new ArrayCollection($this->channels);
    }
}
