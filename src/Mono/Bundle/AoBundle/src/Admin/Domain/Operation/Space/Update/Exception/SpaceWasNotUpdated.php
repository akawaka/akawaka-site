<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Update\Exception;

final class SpaceWasNotUpdated extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during Update process', $id)
        );
    }
}
