<?php

declare(strict_types=1);

namespace App\Contact\Application\Gateway\SendContact;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'contact.send';
}
