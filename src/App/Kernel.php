<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../../config/{packages}/*.php');
        $container->import('../../config/{packages}/'.$this->environment.'/*.php');

        if (is_file(\dirname(__DIR__).'/../config/services.yaml')) {
            $container->import('../../config/services.yaml');
            $container->import('../../config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/../config/services.php')) {
            $container->import('../../config/services.php');
            $container->import('../../config/{services}_'.$this->environment.'.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../../config/{routes}/'.$this->environment.'/*.php');
        $routes->import('../../config/{routes}/*.php');

        if (is_file(\dirname(__DIR__).'/../config/routes.yaml')) {
            $routes->import('../../config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/../config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}