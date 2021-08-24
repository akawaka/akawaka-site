<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Delete\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;

interface WriterInterface
{
    public function delete(AuthorId $id): bool;
}
