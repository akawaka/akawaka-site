<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create\Exception;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class AlreadyExistingPageException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s already exist', $id->getValue())
        );
    }
}
