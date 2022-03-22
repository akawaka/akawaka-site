<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Unpublish;

use App\Shared\Domain\Identifier\ArticleId;

interface CloserInterface
{
    public function close(ArticleId $id): void;
}
