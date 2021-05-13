<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Mono\Bundle\AoBundle\Infrastructure\DependencyInjection\MonoAoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MonoAoBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new MonoAoExtension();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $this->addRegisterMappingPass($container);
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    private function addRegisterMappingPass(ContainerBuilder $container)
    {
        $mappings = [
            realpath($this->getPath().'/config/doctrine/cms/entity') => 'Mono\Bundle\AoBundle\CMS\Domain\Entity',
            realpath($this->getPath().'/config/doctrine/security/entity') => 'Mono\Bundle\AoBundle\Security\Domain\Entity',
         ];

        if (class_exists(DoctrineOrmMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                ),
            );
        }
    }
}
