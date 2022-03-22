<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Update\Exception;

use App\Shared\Domain\Identifier\CategoryId;

final class UnknownCategoryException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s is unknown', $id->getValue())
        );
    }
}
