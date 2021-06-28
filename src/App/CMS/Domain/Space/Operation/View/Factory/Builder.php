<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\View\Factory;

use App\CMS\Domain\Space\Operation\View\Model\Space;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Common\ValueObject\SpaceCode;
use App\CMS\Domain\Space\Operation\View\Model\SpaceInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $space = []): SpaceInterface
    {
        return new Space(
            new SpaceId($space['id']),
            new SpaceCode($space['code']),
            $space['name'],
            $space['status'],
            \DateTimeImmutable::createFromFormat('Y-m-d', $space['creation_date']),
            null !== $space['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d', $space['last_update']) : null,
            $space['url'],
            $space['description'],
            $space['theme'],
        );
    }
}
