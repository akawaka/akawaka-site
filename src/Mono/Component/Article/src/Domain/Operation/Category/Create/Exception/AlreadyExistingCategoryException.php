<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Create\Exception;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

final class AlreadyExistingCategoryException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s already exist', $id->getValue())
        );
    }
}
