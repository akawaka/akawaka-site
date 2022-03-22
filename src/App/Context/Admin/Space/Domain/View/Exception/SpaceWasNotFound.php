<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\View\Exception;

final class SpaceWasNotFound extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s is unknown', $identifier)
        );
    }
}
