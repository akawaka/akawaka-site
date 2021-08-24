<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View\Model\AuthorInterface;

interface ViewerInterface
{
    public function read(AuthorId $id): ?AuthorInterface;

    public function readBySlug(Slug $slug): ?AuthorInterface;

    public function readAll(): array;
}
