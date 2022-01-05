<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Publish\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface PublishPersisterInterface
{
    public function publish(PageId $id): bool;
}
