<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Publish\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class PublishFailedException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during publish process', $id->getValue())
        );
    }
}
