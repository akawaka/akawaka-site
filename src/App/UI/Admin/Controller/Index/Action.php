<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Index;

use App\UI\Admin\Controller\RouteName;
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
        path: RouteName::ADMIN_INDEX['path'],
        name: RouteName::ADMIN_INDEX['name'],
        methods: ['GET'])
    ]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/index');
    }
}
