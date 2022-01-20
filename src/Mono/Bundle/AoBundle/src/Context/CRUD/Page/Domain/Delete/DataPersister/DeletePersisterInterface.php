<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Delete\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface DeletePersisterInterface
{
    public function delete(PageId $id): bool;
}
