<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Update\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Category %s failed during Update process', $id)
        );
    }
}
