<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\View\Repository;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

interface ReaderInterface
{
    public function get(AuthorId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
