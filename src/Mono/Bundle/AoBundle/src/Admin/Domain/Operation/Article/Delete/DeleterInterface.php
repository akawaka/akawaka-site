<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

interface DeleterInterface
{
    public function delete(ArticleId $id): void;
}
