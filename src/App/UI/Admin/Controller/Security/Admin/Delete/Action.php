<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Delete;

use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\DeleteUser;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private DeleteUser\Gateway $removeUserGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_SECURITY_ADMINS_DELETE['path'],
        name: Routes::ADMIN_SECURITY_ADMINS_DELETE['name'],
        methods: ['GET']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->removeUserGateway)(DeleteUser\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('admin_user.removed.success', 'success');

        return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_SECURITY_ADMINS_INDEX['name']));
    }
}
