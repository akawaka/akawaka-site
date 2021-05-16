<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\DependencyInjection;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;
use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlockRegistryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

final class MonoUIExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../../config')
        );

        $loader->load('services.php');

        if ($container->getParameter('kernel.debug')) {
            $loader->load('services/debug/template_event.php');
        }

        if ('test' === $container->getParameter('kernel.environment')) {
            $loader->load('services_test.php');
        }

        $this->loadEvents($config['events'], $container);
    }

    private function loadEvents(array $eventsConfig, ContainerBuilder $container): void
    {
        $templateBlockRegistryDefinition = $container->findDefinition(TemplateBlockRegistryInterface::class);

        $blocksForEvents = [];
        foreach ($eventsConfig as $eventName => $eventConfiguration) {
            $blocksPriorityQueue = new \SplPriorityQueue();

            foreach ($eventConfiguration['blocks'] as $blockName => $details) {
                $details['name'] = $blockName;
                $details['eventName'] = $eventName;

                $blocksPriorityQueue->insert($details, $details['priority'] ?? 0);
            }

            foreach (clone $blocksPriorityQueue as $details) {
                $blocksForEvents[$eventName][$details['name']] = new Definition(TemplateBlock::class, [
                    $details['name'],
                    $details['eventName'],
                    $details['template'],
                    $details['context'],
                    $details['priority'],
                    $details['enabled'],
                ]);
            }
        }

        $templateBlockRegistryDefinition->setArgument(0, $blocksForEvents);
    }
}
