<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Publish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface PublisherInterface
{
    public function publish(ArticleId $id): void;
}
