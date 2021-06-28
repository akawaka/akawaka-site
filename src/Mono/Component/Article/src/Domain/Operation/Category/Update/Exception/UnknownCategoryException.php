<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Update\Exception;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

final class UnknownCategoryException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s is unknown', $id->getValue())
        );
    }
}
