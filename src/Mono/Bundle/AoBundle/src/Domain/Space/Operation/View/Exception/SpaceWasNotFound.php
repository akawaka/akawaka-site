<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\View\Exception;

final class SpaceWasNotFound extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s is unknown', $identifier)
        );
    }
}
