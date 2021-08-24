<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

interface ReaderInterface
{
    public function get(AuthorId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
