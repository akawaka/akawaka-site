<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Unpublish\Exception;

use App\Shared\Domain\Identifier\PageId;

final class CloseFailedException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during close process', $id->getValue())
        );
    }
}
