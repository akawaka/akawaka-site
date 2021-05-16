<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Renderer;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlockRegistryInterface;

final class DelegatingTemplateEventRenderer implements TemplateEventRendererInterface
{
    public function __construct(
        private TemplateBlockRegistryInterface $templateBlockRegistry,
        private TemplateBlockRendererInterface $templateBlockRenderer
    ) {
    }

    public function render(array $eventNames, array $context = []): string
    {
        $templateBlocks = $this->templateBlockRegistry->findEnabledForEvents($eventNames);
        $renderedTemplates = [];

        foreach ($templateBlocks as $templateBlock) {
            $renderedTemplates[] = $this->templateBlockRenderer->render($templateBlock, $context);
        }

        return implode("\n", $renderedTemplates);
    }
}
