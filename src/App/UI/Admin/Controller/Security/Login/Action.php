<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Login;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private Security $security,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private AuthenticationUtils $authenticationUtils,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_LOGIN['path'],
        name: RouteName::ADMIN_LOGIN['name'],
        methods: ['GET', 'POST']
    )
    ]
    public function __invoke(): Response
    {
        if (true === $this->isAuthenticated()) {
            return ($this->redirectResponder)(
                $this->urlGenerator->generate(RouteName::ADMIN_INDEX['name'])
            );
        }

        return ($this->htmlResponder)('Admin/login', [
            'last_username' => $this->authenticationUtils->getLastUsername(),
            'error' => $this->authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    private function isAuthenticated(): bool
    {
        if (null === $this->security->getUser()) {
            return false;
        }

        return true;
    }
}
