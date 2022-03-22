<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Gateway\BrowsePages;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'page.browse';
}
