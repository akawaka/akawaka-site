<?php

declare(strict_types=1);

namespace App\CMS\Domain\Page\Operation\Unpublish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface CloserInterface
{
    public function close(PageId $id): void;
}
