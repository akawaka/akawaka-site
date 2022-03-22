<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\FindSpaceByHostname;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'space.find_by_hostname';
}
