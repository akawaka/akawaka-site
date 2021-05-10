<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Templating;

interface TemplatingInterface
{
    public function render(string $name, array $parameters): string;
}
