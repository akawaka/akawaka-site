<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Delete;

use App\UI\Admin\Controller\RouteName;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Article\Application\Gateway\RemoveArticle;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private RemoveArticle\Gateway $removeArticleGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_ARTICLES_DELETE['path'],
        name: RouteName::ADMIN_CMS_ARTICLES_DELETE['name'],
        methods: ['GET']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->removeArticleGateway)(RemoveArticle\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('article.removed.success', 'success');

        return ($this->redirectResponder)($this->urlGenerator->generate(RouteName::ADMIN_CMS_ARTICLES_INDEX['name']));
    }
}