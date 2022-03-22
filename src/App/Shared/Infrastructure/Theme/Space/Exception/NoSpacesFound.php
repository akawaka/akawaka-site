<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Theme\Space\Exception;

final class NoSpacesFound extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            \Safe\sprintf('There is no space available')
        );
    }
}
