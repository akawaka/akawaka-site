<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Delete\Exception;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during delete process', $id->getValue())
        );
    }
}
