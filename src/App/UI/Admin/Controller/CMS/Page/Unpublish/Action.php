<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Unpublish;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Page\Application\Gateway\UnpublishPage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private UnpublishPage\Gateway $unpublishPageGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_PAGES_UNPUBLISH['path'],
        name: RouteName::ADMIN_CMS_PAGES_UNPUBLISH['name'],
        methods: ['GET']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->unpublishPageGateway)(UnpublishPage\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return ($this->redirectResponder)($this->urlGenerator->generate(RouteName::ADMIN_CMS_PAGES_INDEX['name']));
    }
}
