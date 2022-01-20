<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Create;

use App\UI\Admin\Controller\CMS\Article\Create\Form\CreateArticleDTO;
use App\UI\Admin\Controller\CMS\Article\Create\Form\CreateArticleType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\CreateArticle;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private CreateArticle\Gateway $createArticleGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_ARTICLES_CREATE['path'],
        name: Routes::ADMIN_CMS_ARTICLES_CREATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreateArticleType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $article = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_ARTICLES_UPDATE['name'], [
                    'identifier' => $article->data()['identifier'],
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Article/create', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): CreateArticle\Response
    {
        /** @var CreateArticleDTO $data */
        $data = $form->getData();

        try {
            /** @var CreateArticle\Response $response */
            $response = ($this->createArticleGateway)(CreateArticle\Request::fromData(
                $data->toArray()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('article.created.success', 'success');

        return $response;
    }
}
