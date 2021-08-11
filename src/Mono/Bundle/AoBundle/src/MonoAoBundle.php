<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle;

use Mono\Bundle\AoBundle\Infrastructure\DependencyInjection\MonoAoExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MonoAoBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new MonoAoExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
