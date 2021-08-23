<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Page\Operation\Unpublish\Exception;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class CloseFailedException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during close process', $id->getValue())
        );
    }
}
