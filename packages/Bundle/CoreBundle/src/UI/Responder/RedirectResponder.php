<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\UI\Responder;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

final class RedirectResponder
{
    public function __invoke(
        string $uri,
        int $status = 302,
        array $headers = []
    ): Response {
        return new RedirectResponse($uri, $status, $headers);
    }
}
