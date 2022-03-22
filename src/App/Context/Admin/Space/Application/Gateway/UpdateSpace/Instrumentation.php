<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\UpdateSpace;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'space.update';
}
