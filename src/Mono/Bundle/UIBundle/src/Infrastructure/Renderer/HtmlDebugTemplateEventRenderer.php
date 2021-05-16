<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Renderer;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;
use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlockRegistryInterface;

final class HtmlDebugTemplateEventRenderer implements TemplateEventRendererInterface
{
    public function __construct(
        private TemplateEventRendererInterface $templateEventRenderer,
        private TemplateBlockRegistryInterface $templateBlockRegistry
    ) {
    }

    public function render(array $eventNames, array $context = []): string
    {
        $shouldRenderHtmlDebug = $this->shouldRenderHtmlDebug(
            $this->templateBlockRegistry->findEnabledForEvents($eventNames)
        );

        $renderedParts = [];

        if ($shouldRenderHtmlDebug) {
            $renderedParts[] = sprintf(
                '<!-- BEGIN EVENT | event name: "%s" -->',
                implode(', ', $eventNames)
            );
        }

        $renderedParts[] = $this->templateEventRenderer->render($eventNames, $context);

        if ($shouldRenderHtmlDebug) {
            $renderedParts[] = sprintf(
                '<!-- END EVENT | event name: "%s" -->',
                implode(', ', $eventNames)
            );
        }

        return implode("\n", $renderedParts);
    }

    private function shouldRenderHtmlDebug(array $templateBlocks): bool
    {
        return count($templateBlocks) === 0 || count(array_filter(
            $templateBlocks,
            static function (TemplateBlock $templateBlock): bool {
                return strrpos($templateBlock->getTemplate(), '.html.twig') !== false;
            })) >= 1;
    }
}
