<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Update\Exception;

use App\Shared\Domain\Identifier\PageId;

final class UnknownPageException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s is unknown', $id->getValue())
        );
    }
}
