<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Publish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

interface PublisherInterface
{
    public function publish(ArticleId $id): void;
}
