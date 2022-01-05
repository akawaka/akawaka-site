<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Unpublish\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface UnpublishPersisterInterface
{
    public function close(PageId $id): bool;
}
