<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Space\Index;

use App\UI\Admin\Controller\Routes;
use App\Context\Admin\Space\Application\Gateway\BrowseSpaces;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private BrowseSpaces\Gateway $findSpacesGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_SPACES_INDEX['path'],
        name: Routes::ADMIN_CMS_SPACES_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Space/index', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): BrowseSpaces\Response
    {
        try {
            $results = ($this->findSpacesGateway)(BrowseSpaces\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
