<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TestHtmlAttributeExtension extends AbstractExtension
{
    public function __construct(
        private string $env = '%kernel.environment%'
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'mono_test_html_attribute',
                function (string $name, ?string $value = null): string {
                    if (strpos($this->env, 'test') === 0) {
                        return sprintf('data-test-%s="%s"', $name, (string) $value);
                    }

                    return '';
                },
                ['is_safe' => ['html']]
            ),
        ];
    }
}
