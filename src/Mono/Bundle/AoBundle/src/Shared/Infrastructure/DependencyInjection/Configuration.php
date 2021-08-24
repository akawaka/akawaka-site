<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Infrastructure\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('mono_ao');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
