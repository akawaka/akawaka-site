<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Delete;

use App\Shared\Domain\Identifier\PageId;

interface DeleterInterface
{
    public function delete(PageId $id): void;
}
