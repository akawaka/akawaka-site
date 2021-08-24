<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Index;

use App\UI\Admin\Controller\Routes;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\FindCategories;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private FindCategories\Gateway $findcategoriesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_CATEGORIES_INDEX['path'],
        name: Routes::ADMIN_CMS_CATEGORIES_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Category/index', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): FindCategories\Response
    {
        try {
            $results = ($this->findcategoriesGateway)(FindCategories\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
