<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Operation\Write\Update;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
        private ?string $content,
        private array $categories,
        private array $authors,
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

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
