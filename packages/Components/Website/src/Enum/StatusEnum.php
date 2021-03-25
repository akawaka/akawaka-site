<?php

declare(strict_types=1);

namespace Black\Component\Website\Enum;

use Black\Component\Website\Exception\UnknownStatusException;

final class StatusEnum
{
    public const DRAFT = 'draft';

    public const PUBLISHED = 'published';

    private static array $sourceName = [
        self::DRAFT => 'website.enum.status.draft',
        self::PUBLISHED => 'website.enum.status.published',
    ];

    public static function getValue(string $source): string
    {
        if (!isset(static::$sourceName[$source])) {
            throw new UnknownStatusException($source);
        }

        return static::$sourceName[$source];
    }

    public static function getValues(): array
    {
        return [
            self::getValue(self::DRAFT) => self::DRAFT,
            self::getValue(self::PUBLISHED) => self::PUBLISHED,
        ];
    }
}
