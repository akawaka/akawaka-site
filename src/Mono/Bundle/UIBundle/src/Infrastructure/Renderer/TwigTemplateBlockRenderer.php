<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Renderer;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;
use Twig\Environment;

final class TwigTemplateBlockRenderer implements TemplateBlockRendererInterface
{
    public function __construct(
        private Environment $environment,
    ) {

    }

    public function render(TemplateBlock $templateBlock, array $context = []): string
    {
        return $this->environment->render(
            $templateBlock->getTemplate(),
            array_replace($templateBlock->getContext(), $context)
        );
    }
}
