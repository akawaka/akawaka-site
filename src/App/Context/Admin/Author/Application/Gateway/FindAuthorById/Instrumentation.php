<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\FindAuthorById;

use Mono\Bundle\CoreBundle\Application\Instrumentation\AbstractGatewayInstrumentation;

final class Instrumentation extends AbstractGatewayInstrumentation
{
    public const NAME = 'author.find_by_id';
}
