<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Delete;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

interface DeleterInterface
{
    public function delete(CategoryId $id): void;
}
