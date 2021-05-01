<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Delete;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\AdminSecurity\Application\Gateway\RemoveUser;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private RemoveUser\Gateway $removeUserGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_SECURITY_ADMINS_DELETE['path'],
        name: RouteName::ADMIN_SECURITY_ADMINS_DELETE['name'],
        methods: ['GET']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->removeUserGateway)(RemoveUser\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return ($this->redirectResponder)($this->urlGenerator->generate(RouteName::ADMIN_SECURITY_ADMINS_LIST['name']));
    }
}
