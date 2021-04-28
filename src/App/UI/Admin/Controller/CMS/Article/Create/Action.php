<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Create;

use App\CMS\Application\Gateway\CreateArticle;
use App\UI\Admin\Controller\CMS\Article\Create\Form\CreateArticleDTO;
use App\UI\Admin\Controller\CMS\Article\Create\Form\CreateArticleType;
use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Core\Application\Gateway\GatewayException;
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
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_ARTICLES_CREATE['path'],
        name: RouteName::ADMIN_CMS_ARTICLES_CREATE['name'],
        methods: ['GET', 'POST']
    ) ]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreateArticleType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $article = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(RouteName::ADMIN_CMS_ARTICLES_UPDATE['name'], [
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
            return ($this->createArticleGateway)(CreateArticle\Request::fromData(
                $data->toArray()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }
}
