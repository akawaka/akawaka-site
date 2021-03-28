<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('black_core');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
