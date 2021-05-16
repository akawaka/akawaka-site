<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Renderer;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;

interface TemplateEventRendererInterface
{
    public function render(array $eventNames, array $context = []): string;
}
