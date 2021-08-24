<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Unpublish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

interface CloserInterface
{
    public function close(PageId $id): void;
}
