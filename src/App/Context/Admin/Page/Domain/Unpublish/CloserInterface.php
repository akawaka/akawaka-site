<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Unpublish;

use App\Shared\Domain\Identifier\PageId;

interface CloserInterface
{
    public function close(PageId $id): void;
}
