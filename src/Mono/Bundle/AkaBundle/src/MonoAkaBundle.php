<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle;

use Mono\Bundle\AkaBundle\Shared\Infrastructure\DependencyInjection\MonoAkaExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MonoAkaBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MonoAkaExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
