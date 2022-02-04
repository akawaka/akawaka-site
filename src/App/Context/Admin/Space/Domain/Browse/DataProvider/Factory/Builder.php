<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Browse\DataProvider\Factory;

use App\Context\Admin\Space\Domain\Browse\DataProvider\Model\Space;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Browse\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Browse\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

final class Builder implements BuilderInterface
{
    public static function build(array $space = []): SpaceInterface
    {
        return new Space(
            new SpaceId($space['id']),
            new Code($space['code']),
            $space['name'],
            $space['status'],
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $space['creation_date']),
            null !== $space['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $space['last_update']) : null,
            $space['url'],
            $space['description'],
            $space['theme'],
        );
    }
}
