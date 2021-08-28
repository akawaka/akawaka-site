<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Model\AuthorInterface;

interface ViewerInterface
{
    public function read(AuthorId $id): ?AuthorInterface;

    public function readBySlug(Slug $slug): ?AuthorInterface;

    public function readAll(): array;
}
