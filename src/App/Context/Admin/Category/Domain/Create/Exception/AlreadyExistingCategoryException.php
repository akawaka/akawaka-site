<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Create\Exception;

use App\Shared\Domain\Identifier\CategoryId;

final class AlreadyExistingCategoryException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s already exist', $id->getValue())
        );
    }
}
