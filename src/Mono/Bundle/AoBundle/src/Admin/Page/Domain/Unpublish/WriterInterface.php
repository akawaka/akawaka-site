<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Unpublish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface WriterInterface
{
    public function close(PageId $id): bool;
}
