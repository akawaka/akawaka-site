<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateArticle;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $name,
        private ?string $slug,
        private array $categories,
        private array $channels,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        $slug = $this->slug;

        if (null === $slug) {
            $slug = $this->getName();
        }

        return new Slug($slug);
    }

    public function getChannels(): ArrayCollection
    {
        return new ArrayCollection($this->channels);
    }

    public function getCategories(): ArrayCollection
    {
        return new ArrayCollection($this->categories);
    }
}
