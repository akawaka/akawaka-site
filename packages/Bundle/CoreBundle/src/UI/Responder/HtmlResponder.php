<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\UI\Responder;

use Black\Component\Core\Infrastructure\Templating\TemplatingInterface;
use Symfony\Component\HttpFoundation\Response;

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
            $template,
            $parameters
        );

        return new Response($template, $status, $headers);
    }
}
