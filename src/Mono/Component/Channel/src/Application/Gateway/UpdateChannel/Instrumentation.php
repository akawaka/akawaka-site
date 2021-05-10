<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\UpdateChannel;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'channel.update';
}
