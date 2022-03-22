<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Publish\DataPersister;

use App\Shared\Domain\Identifier\PageId;

interface PublishPersisterInterface
{
    public function publish(PageId $id): bool;
}
