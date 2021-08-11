<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Operation\Write\Update;

use Mono\Component\Core\Infrastructure\Slugger\Slugger;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
        private ?string $content,
        private array $categories,
        private array $spaces,
    ) {
    }

    public function getId(): ArticleId
    {
        return new ArticleId($this->identifier);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug(Slugger::slugify($this->slug));
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
