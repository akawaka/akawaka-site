<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Unpublish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface CloserInterface
{
    public function close(ArticleId $id): void;
}
