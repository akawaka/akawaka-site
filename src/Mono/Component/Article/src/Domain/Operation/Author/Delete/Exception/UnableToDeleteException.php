<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Delete\Exception;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author %s failed during delete process', $id->getValue())
        );
    }
}
