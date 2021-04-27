<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\List;

use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\Article\Application\Gateway\FindArticles;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class Action
{
    public function __construct(
        private FindArticles\Gateway $findArticlesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Article/list', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): FindArticles\Response
    {
        try {
            $results = ($this->findArticlesGateway)(FindArticles\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
