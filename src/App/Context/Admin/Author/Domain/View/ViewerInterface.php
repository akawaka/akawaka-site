<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\View;

use App\Context\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;
use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(AuthorId $id): ?AuthorInterface;

    public function readBySlug(Slug $slug): ?AuthorInterface;
}
