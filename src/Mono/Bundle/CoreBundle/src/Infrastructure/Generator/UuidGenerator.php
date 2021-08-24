<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Generator;

use Ramsey\Uuid\Uuid;

final class UuidGenerator implements GeneratorInterface
{
    public static function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
