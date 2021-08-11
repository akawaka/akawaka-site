<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Article\Operation\Unpublish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

interface CloserInterface
{
    public function close(ArticleId $id): void;
}
