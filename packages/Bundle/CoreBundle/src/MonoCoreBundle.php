<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle;

use Mono\Bundle\CoreBundle\Infrastructure\DependencyInjection\MonoCoreExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MonoCoreBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new MonoCoreExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
