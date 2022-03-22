<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\View\Exception;

final class UnknownCategoryException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s is unknown', $identifier)
        );
    }
}
