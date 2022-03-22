<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Gateway\CreatePage;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'page.create';
}
