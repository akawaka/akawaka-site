<?php

declare(strict_types=1);

namespace App\Context\Front\Contact\Application\Gateway\SendMessage;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'contact.send';
}
