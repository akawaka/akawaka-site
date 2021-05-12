<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Update;

use App\UI\Admin\Controller\CMS\Category\Update\Form\UpdateCategoryDTO;
use App\UI\Admin\Controller\CMS\Category\Update\Form\UpdateCategoryType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Article\Application\Gateway\FindCategoryById;
use Mono\Component\Article\Application\Gateway\UpdateCategory;
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
        private FindCategoryById\Gateway $findCategoryGateway,
        private UrlGeneratorInterface $urlGenerator,
        private UpdateCategory\Gateway $updateCategoryGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_CATEGORIES_UPDATE['path'],
        name: Routes::ADMIN_CMS_CATEGORIES_UPDATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier, Request $request): Response
    {
        try {
            $category = $this->find($identifier);
        } catch (HttpExceptionInterface $exception) {
            return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_CATEGORIES_INDEX['name']));
        }

        $form = $this->formFactory->create(UpdateCategoryType::class);
        $form->setData($category->getCategory());
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form, $category);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_CATEGORIES_UPDATE['name'], [
                    'identifier' => $identifier,
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Category/update', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    private function find(string $identifier): FindCategoryById\Response
    {
        try {
            return ($this->findCategoryGateway)(FindCategoryById\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function process(FormInterface $form, FindCategoryById\Response $category): UpdateCategory\Response
    {
        /** @var UpdateCategoryDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->updateCategoryGateway)(UpdateCategory\Request::fromData(array_merge(
                $category->data(),
                $data->data()
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('category.updated.success', 'success');

        return $response;
    }
}
