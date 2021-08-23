<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Article\Operation\Publish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

interface WriterInterface
{
    public function publish(ArticleId $id): bool;
}
