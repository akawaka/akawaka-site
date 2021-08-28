<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Unpublish\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class CloseFailedException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during close process', $id->getValue())
        );
    }
}
