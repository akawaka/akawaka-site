<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Index;

use App\UI\Admin\Controller\Routes;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\BrowseCategories;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private BrowseCategories\Gateway $findcategoriesGateway,
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

    private function find(): BrowseCategories\Response
    {
        try {
            /** @var BrowseCategories\Response $results */
            $results = ($this->findcategoriesGateway)(BrowseCategories\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
