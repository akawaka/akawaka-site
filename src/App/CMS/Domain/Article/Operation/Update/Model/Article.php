<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Update\Model;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\Update\Model\ArticleInterface;

final class Article implements ArticleInterface
{
    public function __construct(
        private ArticleId $id,
        private Slug $slug,
        private string $name,
        private ?string $content,
        private array $categories = [],
        private array $spaces = [],
    ) {
    }

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
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
