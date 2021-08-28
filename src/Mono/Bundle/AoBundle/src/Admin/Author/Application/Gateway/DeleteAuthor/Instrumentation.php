<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\DeleteAuthor;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractInstrumentation;

final class Instrumentation extends AbstractInstrumentation
{
    public const NAME = 'author.delete';
}
