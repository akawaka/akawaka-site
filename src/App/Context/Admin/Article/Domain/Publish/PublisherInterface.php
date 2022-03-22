<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Publish;

use App\Shared\Domain\Identifier\ArticleId;

interface PublisherInterface
{
    public function publish(ArticleId $id): void;
}
