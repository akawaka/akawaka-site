<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Index;

use App\UI\Admin\Controller\Routes;
use App\Context\Admin\Page\Application\Gateway\BrowsePages;
use App\Context\Admin\Page\Application\Gateway\BrowsePages\Request;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private BrowsePages\Gateway $findPagesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_PAGES_INDEX['path'],
        name: Routes::ADMIN_CMS_PAGES_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Page/index', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): BrowsePages\Response
    {
        try {
            /** @var \App\Context\Admin\Page\Application\Gateway\BrowsePages\Response $results */
            $results = ($this->findPagesGateway)(Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
