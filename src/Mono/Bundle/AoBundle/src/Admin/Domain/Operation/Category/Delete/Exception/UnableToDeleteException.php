<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Delete\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category %s failed during delete process', $id->getValue())
        );
    }
}
