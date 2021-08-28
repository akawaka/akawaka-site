<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\View\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ReaderInterface
{
    public function get(AuthorId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
