<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\UI\Responder;

use Black\Bundle\CoreBundle\Infrastructure\Templating\TemplatingInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HtmlResponder
{
    private TemplatingInterface $templating;

    public function __construct(TemplatingInterface $templating)
    {
        $this->templating = $templating;
    }

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
