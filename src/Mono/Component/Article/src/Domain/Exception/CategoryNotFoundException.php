<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Exception;

final class CategoryNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Category with identifier %s is unknown', $identifier)
        );
    }
}
