<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\DependencyInjection;

use Mono\Bundle\AoBundle\Infrastructure\Theme\ThemeContext;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

final class MonoAoExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
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

    public function prepend(ContainerBuilder $container)
    {
        $this->prependTheme($container);
    }

    private function prependTheme(ContainerBuilder $container)
    {
        if (false === $container->hasExtension('sylius_theme')) {
            return;
        }

        $container->prependExtensionConfig('sylius_theme', [
            'context' => ThemeContext::class,
        ]);
    }
}
