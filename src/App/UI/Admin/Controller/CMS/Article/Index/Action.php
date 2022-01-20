<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Index;

use App\UI\Admin\Controller\Routes;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticles;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticles\Request;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private FindArticles\Gateway $findArticlesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_ARTICLES_INDEX['path'],
        name: Routes::ADMIN_CMS_ARTICLES_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Article/index', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): FindArticles\Response
    {
        try {
            /** @var FindArticles\Response $results */
            $results = ($this->findArticlesGateway)(Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
