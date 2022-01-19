<?php

declare(strict_types=1);

namespace App\Admin\Space\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\Factory\BuilderInterface;
use App\Admin\Space\Domain\Update\DataPersister\Model\Space;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $space = []): SpaceInterface
    {
        return new Space(
            $space['id'],
            $space['name'],
            $space['url'],
            $space['description'],
            $space['theme'],
        );
    }
}
