<?php

declare(strict_types=1);

namespace Black\Component\Page\Enum;

use Black\Component\Page\Exception\UnknownStatusException;

final class StatusEnum
{
    public const DRAFT = 'draft';

    public const PUBLISHED = 'published';

    /**
     * @var array<string>
     */
    private static array $sourceName = [
        self::DRAFT => 'page.enum.status.draft',
        self::PUBLISHED => 'page.enum.status.published',
    ];

    public static function getValue(string $source): string
    {
        if (!isset(static::$sourceName[$source])) {
            throw new UnknownStatusException($source);
        }

        return static::$sourceName[$source];
    }

    /**
     * @return array<string>
     * @throws UnknownStatusException
     */
    public static function getValues(): array
    {
        return [
            self::getValue(self::DRAFT) => self::DRAFT,
            self::getValue(self::PUBLISHED) => self::PUBLISHED,
        ];
    }
}
