<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Mono\Bundle\UIBundle\Infrastructure\DependencyInjection\MonoUIExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MonoUIBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new MonoUIExtension();
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
            realpath($this->getPath().'/config/doctrine/cms/entity') => 'Mono\Bundle\UIBundle\CMS\Domain\Entity',
            realpath($this->getPath().'/config/doctrine/security/entity') => 'Mono\Bundle\UIBundle\Security\Domain\Entity',
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
