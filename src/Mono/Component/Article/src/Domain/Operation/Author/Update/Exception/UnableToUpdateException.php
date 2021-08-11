<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Update\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Author %s failed during Update process', $id)
        );
    }
}
