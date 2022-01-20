<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Templating;

interface TemplatingInterface
{
    /**
     * @param array<array-key, mixed> $parameters
     */
    public function render(string $name, array $parameters = []): string;
}
