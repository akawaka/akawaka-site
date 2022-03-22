<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Update;

use App\UI\Admin\Controller\CMS\Page\Update\Form\UpdatePageDTO;
use App\UI\Admin\Controller\CMS\Page\Update\Form\UpdatePageType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use App\Context\Admin\Page\Application\Gateway\FindPageById;
use App\Context\Admin\Page\Application\Gateway\UpdatePage;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
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
        private FindPageById\Gateway $findPageGateway,
        private UrlGeneratorInterface $urlGenerator,
        private UpdatePage\Gateway $updatePageGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_PAGES_UPDATE['path'],
        name: Routes::ADMIN_CMS_PAGES_UPDATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier, Request $request): Response
    {
        try {
            $page = $this->find($identifier);
        } catch (HttpExceptionInterface $exception) {
            return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_PAGES_INDEX['name']));
        }

        $form = $this->formFactory->create(UpdatePageType::class);
        $form->setData($page->getPage());
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form, $page);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_PAGES_UPDATE['name'], [
                    'identifier' => $identifier,
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Page/update', [
            'form' => $form->createView(),
            'page' => $page->data(),
        ]);
    }

    private function find(string $identifier): FindPageById\Response
    {
        try {
            // @var FindPageById\Response $response
            return ($this->findPageGateway)(FindPageById\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function process(FormInterface $form, FindPageById\Response $page): UpdatePage\Response
    {
        /** @var UpdatePageDTO $data */
        $data = $form->getData();

        try {
            /** @var \App\Context\Admin\Page\Application\Gateway\UpdatePage\Response $response */
            $response = ($this->updatePageGateway)(\App\Context\Admin\Page\Application\Gateway\UpdatePage\Request::fromData(array_merge(
                $page->data(),
                $data->data()
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('page.updated.success', 'success');

        return $response;
    }
}
