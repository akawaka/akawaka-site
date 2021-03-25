<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BlackPeanutBundle extends Bundle
{
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
            realpath($this->getPath().'/config/doctrine/entity/Page') => 'Black\Bundle\PeanutBundle\Domain\Entity\Page',
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
