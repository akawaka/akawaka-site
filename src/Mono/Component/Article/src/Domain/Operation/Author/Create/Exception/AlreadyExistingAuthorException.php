<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Create\Exception;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

final class AlreadyExistingAuthorException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author with identifier %s already exist', $id->getValue())
        );
    }
}
