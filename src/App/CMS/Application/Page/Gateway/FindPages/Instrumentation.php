<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\FindPages;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'page.find_all';
}
