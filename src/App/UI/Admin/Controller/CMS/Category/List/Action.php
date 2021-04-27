<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\List;

use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\Article\Application\Gateway\FindCategories;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class Action
{
    public function __construct(
        private FindCategories\Gateway $findcategoriesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Category/list', [
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
