<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Delete;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

interface DeleterInterface
{
    public function delete(ArticleId $id): void;
}
