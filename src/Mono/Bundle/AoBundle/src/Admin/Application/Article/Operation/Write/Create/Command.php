<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Write\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

final class Command
{
    public function __construct(
        private ArticleId $id,
        private string $name,
        private ?string $slug,
        private array $categories,
        private array $authors,
        private array $spaces,
    ) {
    }

    public function getId(): ArticleId
    {
        return $this->id;
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

        return new Slug(Slugger::slugify($slug));
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
