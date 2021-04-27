<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Contact\Form\Enum;

final class BudgetEnum
{
    const LOW = '-25';

    const MIDDLE = '2550';

    const HIGH = '50100';

    const VERY_HIGH = '100+';

    private static array $sourceName = [
        self::LOW => 'contact.enum.budget.low',
        self::MIDDLE => 'contact.enum.budget.middle',
        self::HIGH => 'contact.enum.budget.high',
        self::VERY_HIGH => 'contact.enum.budget.very_high',
    ];

    public static function getValue(string $source): string
    {
        if (!isset(static::$sourceName[$source])) {
            throw new UnknownBudgetException($source);
        }

        return static::$sourceName[$source];
    }

    public static function getValues(): array
    {
        return [
            self::getValue(self::LOW) => self::LOW,
            self::getValue(self::MIDDLE) => self::MIDDLE,
            self::getValue(self::HIGH) => self::HIGH,
            self::getValue(self::VERY_HIGH) => self::VERY_HIGH,
        ];
    }
}
