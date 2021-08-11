<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Page\Operation\Unpublish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface WriterInterface
{
    public function close(PageId $id): bool;
}
