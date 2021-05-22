<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Exception;

final class SpaceNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier or code %s is unknown', $identifier)
        );
    }
}
