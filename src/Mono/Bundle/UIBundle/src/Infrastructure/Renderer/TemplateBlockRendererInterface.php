<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Renderer;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;

interface TemplateBlockRendererInterface
{
    public function render(TemplateBlock $templateBlock, array $context = []): string;
}
