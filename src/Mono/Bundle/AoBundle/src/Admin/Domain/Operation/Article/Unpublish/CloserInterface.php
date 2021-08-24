<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Unpublish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

interface CloserInterface
{
    public function close(ArticleId $id): void;
}
