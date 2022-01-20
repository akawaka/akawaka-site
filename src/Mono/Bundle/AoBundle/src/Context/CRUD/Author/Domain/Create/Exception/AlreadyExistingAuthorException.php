<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;

final class AlreadyExistingAuthorException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author with identifier %s already exist', $id->getValue())
        );
    }
}
