<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Update;

use App\UI\Admin\Controller\CMS\Article\Update\Form\UpdateArticleDTO;
use App\UI\Admin\Controller\CMS\Article\Update\Form\UpdateArticleType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use App\CMS\Application\Article\Gateway\FindArticleById;
use Mono\Component\Article\Application\Gateway\Article\FindArticleById as BaseArticleById;
use App\CMS\Application\Article\Gateway\UpdateArticle;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private FindArticleById\Gateway $findArticleGateway,
        private UrlGeneratorInterface $urlGenerator,
        private UpdateArticle\Gateway $updateArticleGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_ARTICLES_UPDATE['path'],
        name: Routes::ADMIN_CMS_ARTICLES_UPDATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier, Request $request): Response
    {
        try {
            $article = $this->find($identifier);
        } catch (HttpExceptionInterface $exception) {
            return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_ARTICLES_INDEX['name']));
        }

        $form = $this->formFactory->create(UpdateArticleType::class);
        $form->setData($article->getArticle());
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form, $article);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_ARTICLES_UPDATE['name'], [
                    'identifier' => $identifier,
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Article/update', [
            'form' => $form->createView(),
            'article' => $article->data(),
        ]);
    }

    private function find(string $identifier): FindArticleById\Response
    {
        try {
            return ($this->findArticleGateway)(BaseArticleById\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function process(FormInterface $form, FindArticleById\Response $article): UpdateArticle\Response
    {
        /** @var UpdateArticleDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->updateArticleGateway)(UpdateArticle\Request::fromData(array_merge(
                $article->data(),
                $data->data()
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('article.updated.success', 'success');

        return $response;
    }
}
