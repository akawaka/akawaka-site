<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;

final class AlreadyExistingAuthorException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author with identifier %s already exist', $id->getValue())
        );
    }
}
