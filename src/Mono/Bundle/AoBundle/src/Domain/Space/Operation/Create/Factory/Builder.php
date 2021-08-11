<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Factory;

use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Model\Space;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Model\SpaceInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $space = []): SpaceInterface
    {
        return new Space(
            $space['id'],
            $space['code'],
            $space['name'],
            $space['theme'],
        );
    }
}
