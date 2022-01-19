<?php

declare(strict_types=1);

namespace App\Admin\Space\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\Factory\BuilderInterface;
use App\Admin\Space\Domain\Create\DataPersister\Model\Space;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;

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
