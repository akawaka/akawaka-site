<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Index;

use App\UI\Admin\Controller\Routes;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\BrowseUsers;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private BrowseUsers\Gateway $findUsersGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: Routes::ADMIN_SECURITY_ADMINS_INDEX['path'],
        name: Routes::ADMIN_SECURITY_ADMINS_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/Security/Admin/index', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): BrowseUsers\Response
    {
        try {
            /** @var BrowseUsers\Response $results */
            $results = ($this->findUsersGateway)(BrowseUsers\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
