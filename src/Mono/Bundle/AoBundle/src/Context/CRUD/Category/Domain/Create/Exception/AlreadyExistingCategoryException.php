<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

final class AlreadyExistingCategoryException extends \Exception
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s already exist', $id->getValue())
        );
    }
}
