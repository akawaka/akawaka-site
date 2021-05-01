<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\List;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Page\Application\Gateway\FindPages;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private FindPages\Gateway $findPagesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_PAGES_LIST['path'],
        name: RouteName::ADMIN_CMS_PAGES_LIST['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Page/list', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): FindPages\Response
    {
        try {
            $results = ($this->findPagesGateway)(FindPages\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
