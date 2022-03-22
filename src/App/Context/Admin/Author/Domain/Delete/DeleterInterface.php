<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Delete;

use App\Shared\Domain\Identifier\AuthorId;

interface DeleterInterface
{
    public function delete(AuthorId $id): void;
}
