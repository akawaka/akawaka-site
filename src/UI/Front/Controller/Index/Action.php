<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Index;

use Black\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;

final class Action
{
    private HtmlResponder $htmlResponder;

    public function __construct(
        HtmlResponder $htmlResponder
    ) {
        $this->htmlResponder = $htmlResponder;
    }

    public function __invoke(): Response
    {
        return ($this->htmlResponder)('front/index');
    }
}
