<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Unpublish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

interface WriterInterface
{
    public function close(ArticleId $id): bool;
}