<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Update\Exception;

use App\Shared\Domain\Identifier\AuthorId;

final class UnknownAuthorException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author with identifier %s is unknown', $id->getValue())
        );
    }
}
