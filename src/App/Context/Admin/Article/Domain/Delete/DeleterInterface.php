<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Delete;

use App\Shared\Domain\Identifier\ArticleId;

interface DeleterInterface
{
    public function delete(ArticleId $id): void;
}
