<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Space\Create;

use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CreateSpace;
use App\UI\Admin\Controller\CMS\Space\Create\Form\CreateSpaceDTO;
use App\UI\Admin\Controller\CMS\Space\Create\Form\CreateSpaceType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
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
        private CreateSpace\Gateway $createSpaceGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_SPACES_CREATE['path'],
        name: Routes::ADMIN_CMS_SPACES_CREATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreateSpaceType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $space = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_SPACES_UPDATE['name'], [
                    'identifier' => $space->data()['identifier'],
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Space/create', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): CreateSpace\Response
    {
        /** @var CreateSpaceDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->createSpaceGateway)(CreateSpace\Request::fromData(
                $data->data()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('space.created.success', 'success');

        return $response;
    }
}
