<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create\Exception;

use App\Shared\Domain\Identifier\PageId;

final class AlreadyExistingPageException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s already exist', $id->getValue())
        );
    }
}
