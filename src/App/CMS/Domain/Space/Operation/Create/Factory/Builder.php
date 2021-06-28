<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Create\Factory;

use App\CMS\Domain\Space\Operation\Create\Model\Space;
use App\CMS\Domain\Space\Operation\Create\Model\SpaceInterface;

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
