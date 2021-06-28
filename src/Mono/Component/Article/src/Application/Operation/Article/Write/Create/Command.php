<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Article\Write\Create;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Core\Infrastructure\Slugger\Slugger;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Command
{
    public function __construct(
        private ArticleId $id,
        private string $name,
        private ?string $slug,
        private array $categories,
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
}