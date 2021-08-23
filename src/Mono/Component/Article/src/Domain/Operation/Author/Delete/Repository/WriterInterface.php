<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Delete\Repository;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

interface WriterInterface
{
    public function delete(AuthorId $id): bool;
}
