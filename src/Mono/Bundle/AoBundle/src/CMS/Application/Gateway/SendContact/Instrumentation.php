<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Application\Gateway\SendContact;

use Mono\Component\Core\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'contact.send';
}
