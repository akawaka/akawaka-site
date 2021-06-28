<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update\Exception;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class UnknownPageException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s is unknown', $id->getValue())
        );
    }
}
