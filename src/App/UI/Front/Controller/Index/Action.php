<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Index;

use App\UI\Front\Controller\Routes;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: Routes::FRONT_INDEX['path'],
        name: Routes::FRONT_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Front/index');
    }
}
