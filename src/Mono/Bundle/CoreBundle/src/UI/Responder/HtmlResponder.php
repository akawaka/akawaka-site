<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\UI\Responder;

use Mono\Bundle\CoreBundle\Infrastructure\Templating\TemplatingInterface;
use Symfony\Component\HttpFoundation\Response;

final class HtmlResponder
{
    public function __construct(
        private TemplatingInterface $templating
    ) {
    }

    /**
     * @param array<array-key, mixed> $parameters
     * @param array<array-key, mixed> $headers
     */
    public function __invoke(
        string $template,
        array $parameters = [],
        int $status = 200,
        array $headers = []
    ): Response {
        $template = $this->templating->render(
            \Safe\sprintf('%s.html.twig', $template),
            $parameters
        );

        return new Response($template, $status, $headers);
    }
}
