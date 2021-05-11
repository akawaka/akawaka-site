<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Publish;

use App\UI\Admin\Controller\RouteName;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Page\Application\Gateway\PublishPage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private PublishPage\Gateway $publishPageGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_PAGES_PUBLISH['path'],
        name: RouteName::ADMIN_CMS_PAGES_PUBLISH['name'],
        methods: ['GET']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->publishPageGateway)(PublishPage\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('page.published.success', 'success');

        return ($this->redirectResponder)($this->urlGenerator->generate(RouteName::ADMIN_CMS_PAGES_INDEX['name']));
    }
}