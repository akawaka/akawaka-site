<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Update\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Author %s failed during Update process', $id)
        );
    }
}
