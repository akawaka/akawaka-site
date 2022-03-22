<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Delete\Exception;

use App\Shared\Domain\Identifier\AuthorId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author %s failed during delete process', $id->getValue())
        );
    }
}
