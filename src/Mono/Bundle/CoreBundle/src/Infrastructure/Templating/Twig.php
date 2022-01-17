<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Templating;

use Twig\Environment;

final class Twig implements TemplatingInterface
{
    private Environment $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param array<string, string> $parameters
     */
    public function render(string $name, array $parameters = []): string
    {
        return $this->environment->render($name, $parameters);
    }
}
