<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Create;

use App\CMS\Application\Gateway\CreateCategory;
use App\UI\Admin\Controller\CMS\Category\Create\Form\CreateCategoryDTO;
use App\UI\Admin\Controller\CMS\Category\Create\Form\CreateCategoryType;
use App\UI\Admin\Controller\RouteName;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
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
        private CreateCategory\Gateway $createCategoryGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_CATEGORIES_CREATE['path'],
        name: RouteName::ADMIN_CMS_CATEGORIES_CREATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreateCategoryType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $category = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(RouteName::ADMIN_CMS_CATEGORIES_UPDATE['name'], [
                    'identifier' => $category->data()['identifier'],
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Category/create', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): CreateCategory\Response
    {
        /** @var CreateCategoryDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->createCategoryGateway)(CreateCategory\Request::fromData(
                $data->data()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('category.created.success', 'success');

        return $response;
    }
}