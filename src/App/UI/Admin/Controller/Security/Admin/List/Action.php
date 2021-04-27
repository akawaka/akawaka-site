<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\List;

use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\AdminSecurity\Application\Gateway\FindUsers;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class Action
{
    public function __construct(
        private FindUsers\Gateway $findUsersGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/Security/Admin/list', [
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
