<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\View\Exception;

final class UnknownPageException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s is unknown', $identifier)
        );
    }
}
