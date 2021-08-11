<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\View;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Author\View\Model\AuthorInterface;

interface ViewerInterface
{
    public function read(AuthorId $id): ?AuthorInterface;

    public function readBySlug(Slug $slug): ?AuthorInterface;

    public function readAll(): array;
}
