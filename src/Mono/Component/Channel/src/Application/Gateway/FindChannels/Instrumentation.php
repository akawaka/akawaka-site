<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\FindChannels;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'channel.find_all';
}
