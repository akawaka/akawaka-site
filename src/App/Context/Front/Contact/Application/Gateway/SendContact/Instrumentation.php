<?php

declare(strict_types=1);

namespace App\Context\Front\Contact\Application\Gateway\SendContact;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'contact.send';
}
