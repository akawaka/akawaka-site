<?php

declare(strict_types=1);

namespace App\CMS\Domain\Page\Operation\Publish\Exception;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class PublishFailedException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during publish process', $id->getValue())
        );
    }
}
