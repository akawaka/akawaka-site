<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Templating;

interface TemplatingInterface
{
    public function render(string $name, array $parameters): string;
}
