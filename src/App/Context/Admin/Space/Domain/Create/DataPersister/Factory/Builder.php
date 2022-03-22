<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Space\Domain\Create\DataPersister\Model\Space;
use App\Context\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;

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
