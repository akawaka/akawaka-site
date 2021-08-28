<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface DeleterInterface
{
    public function delete(ArticleId $id): void;
}
