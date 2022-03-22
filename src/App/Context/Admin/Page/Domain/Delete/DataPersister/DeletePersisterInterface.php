<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Delete\DataPersister;

use App\Shared\Domain\Identifier\PageId;

interface DeletePersisterInterface
{
    public function delete(PageId $id): bool;
}
