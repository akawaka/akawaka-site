<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TestFormAttributeExtension extends AbstractExtension
{
    public function __construct(
        private string $env = '%kernel.environment%'
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'mono_test_form_attribute',
                function (string $name, ?string $value = null): array {
                    if (strpos($this->env, 'test') === 0) {
                        return ['attr' => ['data-test-' . $name => (string) $value]];
                    }

                    return [];
                },
                ['is_safe' => ['html']]
            ),
        ];
    }
}
