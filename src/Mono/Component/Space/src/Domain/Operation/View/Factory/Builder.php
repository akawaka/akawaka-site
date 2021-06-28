<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\View\Factory;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;
use Mono\Component\Space\Domain\Operation\View\Model\Space;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

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
        );
    }
}
