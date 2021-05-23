<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\FindSpaceByCode;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'space.find_by_code';
}
