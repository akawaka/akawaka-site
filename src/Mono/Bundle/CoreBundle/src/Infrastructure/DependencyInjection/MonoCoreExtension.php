<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

final class MonoCoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../../config')
        );

        $loader->load('services.php');

        if ('test' === $container->getParameter('kernel.environment')) {
            $loader->load('services_test.php');
        }
    }
}
