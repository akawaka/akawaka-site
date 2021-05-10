<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\ResetPasswordSuccess;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private HtmlResponder $htmlResponder,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_SECURITY_PASSWORD_RESET_SUCCESS['path'],
        name: RouteName::ADMIN_SECURITY_PASSWORD_RESET_SUCCESS['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        return ($this->htmlResponder)('Admin/Security/Reset/reset_success');
    }
}
