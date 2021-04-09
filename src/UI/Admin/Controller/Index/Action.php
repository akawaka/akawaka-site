<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Index;

use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;

final class Action
{
    public function __construct(
        private HtmlResponder $htmlResponder
    ) {
    }

    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/index');
    }
}
