<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\FindSpaceById;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'space.find_by_id';
}
