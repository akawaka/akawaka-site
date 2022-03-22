<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during Update process', $id)
        );
    }
}
