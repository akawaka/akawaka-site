<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Delete;

use App\Shared\Domain\Identifier\CategoryId;

interface DeleterInterface
{
    public function delete(CategoryId $id): void;
}
