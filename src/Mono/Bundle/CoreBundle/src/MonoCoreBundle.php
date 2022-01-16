<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle;

use Mono\Bundle\CoreBundle\Infrastructure\DependencyInjection\MonoCoreExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MonoCoreBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MonoCoreExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
