<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Delete\Repository;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

interface WriterInterface
{
    public function delete(ArticleId $id): bool;
}
