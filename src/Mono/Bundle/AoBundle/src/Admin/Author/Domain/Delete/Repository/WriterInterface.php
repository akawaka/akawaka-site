<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Delete\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;

interface WriterInterface
{
    public function delete(AuthorId $id): bool;
}
