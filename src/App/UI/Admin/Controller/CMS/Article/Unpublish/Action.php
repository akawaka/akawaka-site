<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Unpublish;

use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UnpublishArticle;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private UnpublishArticle\Gateway $unpublishArticleGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_ARTICLES_UNPUBLISH['path'],
        name: Routes::ADMIN_CMS_ARTICLES_UNPUBLISH['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->unpublishArticleGateway)(UnpublishArticle\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('article.unpublished.success', 'success');

        return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_ARTICLES_INDEX['name']));
    }
}
