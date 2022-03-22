<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\View\DataProvider\Model;

use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;

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
