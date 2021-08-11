<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\View\Model;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

final class Author implements AuthorInterface
{
    public function __construct(
        private AuthorId $id,
        private Slug $slug,
        private string $name,
    ) {
    }

    public function getId(): AuthorId
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
}
