<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Delete\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

interface WriterInterface
{
    public function delete(ArticleId $id): bool;
}
