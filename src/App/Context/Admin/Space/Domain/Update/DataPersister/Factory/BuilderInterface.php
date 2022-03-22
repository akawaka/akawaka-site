<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Update\DataPersister\Factory;

use App\Context\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;

interface BuilderInterface
{
    public static function build(array $space = []): SpaceInterface;
}
