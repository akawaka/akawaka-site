<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Delete\Exception;

use App\Shared\Domain\Identifier\PageId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during delete process', $id->getValue())
        );
    }
}
