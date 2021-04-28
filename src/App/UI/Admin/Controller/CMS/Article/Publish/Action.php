<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Publish;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Article\Application\Gateway\PublishArticle;
use Mono\Component\Core\Application\Gateway\GatewayException;
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
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_ARTICLES_PUBLISH['path'],
        name: RouteName::ADMIN_CMS_ARTICLES_PUBLISH['name'],
        methods: ['GET', 'POST']
    ) ]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->publishArticleGateway)(PublishArticle\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return ($this->redirectResponder)($this->urlGenerator->generate(RouteName::ADMIN_CMS_ARTICLES_LIST['name']));
    }
}
