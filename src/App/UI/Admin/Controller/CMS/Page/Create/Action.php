<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Create;

use Mono\Bundle\AoBundle\Application\Page\Gateway\CreatePage;
use App\UI\Admin\Controller\CMS\Page\Create\Form\CreatePageDTO;
use App\UI\Admin\Controller\CMS\Page\Create\Form\CreatePageType;
use App\UI\Admin\Controller\Routes;
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
        private CreatePage\Gateway $createPageGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_PAGES_CREATE['path'],
        name: Routes::ADMIN_CMS_PAGES_CREATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreatePageType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $page = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_PAGES_UPDATE['name'], [
                    'identifier' => $page->data()['identifier'],
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Page/create', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): \Mono\Component\Page\Application\Gateway\CreatePage\Response
    {
        /** @var CreatePageDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->createPageGateway)(CreatePage\Request::fromData(
                $data->toArray()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('page.created.success', 'success');

        return $response;
    }
}
