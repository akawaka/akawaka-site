<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Publish;

use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\PublishArticle;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\PublishArticle\Request;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private PublishArticle\Gateway $publishArticleGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_ARTICLES_PUBLISH['path'],
        name: Routes::ADMIN_CMS_ARTICLES_PUBLISH['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->publishArticleGateway)(Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('article.published.success', 'success');

        return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_ARTICLES_INDEX['name']));
    }
}
