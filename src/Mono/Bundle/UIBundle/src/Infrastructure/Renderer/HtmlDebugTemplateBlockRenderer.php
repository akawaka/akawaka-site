<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Renderer;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;

final class HtmlDebugTemplateBlockRenderer implements TemplateBlockRendererInterface
{
    public function __construct(
        private TemplateBlockRendererInterface $templateBlockRenderer
    ) {
    }

    public function render(TemplateBlock $templateBlock, array $context = []): string
    {
        $shouldRenderHtmlDebug = strrpos($templateBlock->getTemplate(), '.html.twig') !== false;

        $renderedParts = [];

        if ($shouldRenderHtmlDebug) {
            $renderedParts[] = sprintf(
                '<!-- BEGIN BLOCK | event name: "%s", block name: "%s", template: "%s", priority: %d -->',
                $templateBlock->getEventName(),
                $templateBlock->getName(),
                $templateBlock->getTemplate(),
                $templateBlock->getPriority()
            );
        }

        $renderedParts[] = $this->templateBlockRenderer->render($templateBlock, $context);

        if ($shouldRenderHtmlDebug) {
            $renderedParts[] = sprintf(
                '<!-- END BLOCK | event name: "%s", block name: "%s" -->',
                $templateBlock->getEventName(),
                $templateBlock->getName()
            );
        }

        return implode("\n", $renderedParts);
    }
}
