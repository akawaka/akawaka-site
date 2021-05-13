<?php

declare(strict_types=1);

namespace App\UI\CLI\Command;

use Nette\Utils\Strings;
use Symfony\Component\Console\Command\Command;

final class CommandNaming
{
    /**
     * @var string
     *
     * @see https://regex101.com/r/DfCWPx/1
     */
    private const BIG_LETTER_REGEX = '#[A-Z]#';

    /**
     * Converts:
     * - "SomeClass\SomeSuperCommand" → "ao:some:super"
     * - "SomeClass\SOMESuperCommand" → "ao:some:super".
     */
    public function resolveFromCommand(Command $command): string
    {
        $commandClass = get_class($command);

        return self::classToName($commandClass);
    }

    /**
     * Converts:
     * - "SomeClass\SomeSuperCommand" → "ao:some:super"
     * - "SomeClass\SOMESuperCommand" → "ao:some:super".
     */
    public static function classToName(string $class): string
    {
        /** @var array $shortClassName */
        $shortClassName = self::resolveShortName($class);

        $name = [];

        foreach ($shortClassName as $part) {
            // ECSCommand => ecs
            for ($i = 0; $i < strlen($part); ++$i) {
                if (ctype_upper($part[$i]) && self::isFollowedByUpperCaseLetterOrNothing($part, $i)) {
                    $part[$i] = strtolower($part[$i]);
                } else {
                    break;
                }
            }

            $part = lcfirst($part);

            $name[] = Strings::replace($part, self::BIG_LETTER_REGEX, function (array $matches): string {
                return '-'.strtolower($matches[0]);
            });
        }

        return sprintf('ao:%s:%s', $name[0], $name[1]);
    }

    private static function resolveShortName(string $class): array
    {
        $classParts = explode('\\', $class);
        $length = count($classParts);

        return [
            $classParts[$length - 2],
            $classParts[$length - 1],
        ];
    }

    private static function isFollowedByUpperCaseLetterOrNothing(string $string, int $position): bool
    {
        // this is the last letter
        if (!isset($string[$position + 1])) {
            return true;
        }

        // next letter is uppercase
        return ctype_upper($string[$position + 1]);
    }
}
