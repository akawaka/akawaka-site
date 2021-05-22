<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateArticle;

use Mono\Component\Article\Domain\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $name,
        private ?string $slug,
        private array $categories,
        private array $spaces,
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

    public function getSpaces(): array
    {
        return $this->spaces;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
}
