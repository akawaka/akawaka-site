<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BlackCoreBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
