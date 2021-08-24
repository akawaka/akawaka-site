<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Delete\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(AuthorId $id)
    {
        parent::__construct(
            \Safe\sprintf('Author %s failed during delete process', $id->getValue())
        );
    }
}
