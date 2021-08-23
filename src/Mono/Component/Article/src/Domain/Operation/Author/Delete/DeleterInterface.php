<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Delete;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

interface DeleterInterface
{
    public function delete(AuthorId $id): void;
}
