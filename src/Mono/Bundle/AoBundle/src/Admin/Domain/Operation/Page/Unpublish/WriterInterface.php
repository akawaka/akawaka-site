<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Unpublish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

interface WriterInterface
{
    public function close(PageId $id): bool;
}
