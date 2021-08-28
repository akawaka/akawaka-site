<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class AlreadyExistingPageException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s already exist', $id->getValue())
        );
    }
}
