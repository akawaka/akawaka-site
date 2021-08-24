<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Instrumentation;

interface Instrumentation
{
    /** @phpstan-ignore-next-line */
    public function getLogger();
}
