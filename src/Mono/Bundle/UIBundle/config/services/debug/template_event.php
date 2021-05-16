<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlockRegistry;
use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlockRegistryInterface;
use Mono\Bundle\UIBundle\Infrastructure\Renderer\DelegatingTemplateEventRenderer;
use Mono\Bundle\UIBundle\Infrastructure\Renderer\HtmlDebugTemplateBlockRenderer;
use Mono\Bundle\UIBundle\Infrastructure\Renderer\HtmlDebugTemplateEventRenderer;
use Mono\Bundle\UIBundle\Infrastructure\Renderer\TemplateBlockRendererInterface;
use Mono\Bundle\UIBundle\Infrastructure\Renderer\TemplateEventRendererInterface;
use Mono\Bundle\UIBundle\Infrastructure\Renderer\TwigTemplateBlockRenderer;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services
        ->set(HtmlDebugTemplateBlockRenderer::class)
        ->decorate(TemplateBlockRendererInterface::class)
    ;

    $services
        ->set(HtmlDebugTemplateEventRenderer::class)
        ->decorate(TemplateEventRendererInterface::class)
    ;
};
