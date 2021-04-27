<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Delete;

use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\AdminSecurity\Application\Gateway\RemoveUser;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private RemoveUser\Gateway $removeUserGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
    ) {
    }

    public function __invoke(string $identifier): Response
    {
        try {
            ($this->removeUserGateway)(RemoveUser\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return ($this->redirectResponder)($this->urlGenerator->generate('admins_index'));
    }
}
