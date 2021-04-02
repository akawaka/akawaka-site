<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Contact;

use Black\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;

final class Action
{
    private HtmlResponder $responder;

    public function __construct(
        HtmlResponder $responder
    ) {
        $this->responder = $responder;
    }

    public function __invoke(): Response
    {
        return ($this->responder)('front/contact');
    }
}
