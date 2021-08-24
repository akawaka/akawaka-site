<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

final class UnknownPageException extends \Exception
{
    public function __construct(PageId $id)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s is unknown', $id->getValue())
        );
    }
}
