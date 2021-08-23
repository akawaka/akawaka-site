<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Page %s failed during Update process', $id)
        );
    }
}
