<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
