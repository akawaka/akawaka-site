<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\UI\Responder;

use Mono\Component\Core\Infrastructure\Templating\TemplatingInterface;
use Symfony\Component\HttpFoundation\Response;

final class HtmlResponder
{
    public function __construct(
        private TemplatingInterface $templating
    ) {
    }

    public function __invoke(
        string $template,
        array $parameters = [],
        int $status = 200,
        array $headers = []
    ): Response {
        $template = $this->templating->render(
            sprintf('%s.html.twig',$template),
            $parameters
        );

        return new Response($template, $status, $headers);
    }
}
