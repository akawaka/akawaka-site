<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Delete\Exception;

use App\Shared\Domain\Identifier\CategoryId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category %s failed during delete process', $id->getValue())
        );
    }
}
