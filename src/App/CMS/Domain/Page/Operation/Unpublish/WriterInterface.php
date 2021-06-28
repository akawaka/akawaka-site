<?php

declare(strict_types=1);

namespace App\CMS\Domain\Page\Operation\Unpublish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface WriterInterface
{
    public function close(PageId $id): bool;
}
