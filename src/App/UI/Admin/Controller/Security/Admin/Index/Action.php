<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Index;

use App\UI\Admin\Controller\Routes;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use App\Security\Application\AdminSecurity\Gateway\FindUsers;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private FindUsers\Gateway $findUsersGateway,
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

    private function find(): FindUsers\Response
    {
        try {
            $results = ($this->findUsersGateway)(FindUsers\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
