<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Unpublish\DataPersister;

use App\Shared\Domain\Identifier\PageId;

interface UnpublishPersisterInterface
{
    public function close(PageId $id): bool;
}
