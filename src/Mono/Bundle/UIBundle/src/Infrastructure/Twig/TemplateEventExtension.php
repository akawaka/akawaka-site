<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Twig;

use Mono\Bundle\UIBundle\Infrastructure\Renderer\TemplateEventRendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TemplateEventExtension extends AbstractExtension
{
    public function __construct(
        private TemplateEventRendererInterface $renderer
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('mono_template_event', [$this, 'render'], ['is_safe' => ['html']]),
        ];
    }

    public function render($eventName, array $context = []): string
    {
        return $this->renderer->render((array) $eventName, $context);
    }
}
