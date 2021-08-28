<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Delete\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface WriterInterface
{
    public function delete(ArticleId $id): bool;
}
