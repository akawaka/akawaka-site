<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Space\Update;

use App\UI\Admin\Controller\CMS\Space\Update\Form\UpdateSpaceDTO;
use App\UI\Admin\Controller\CMS\Space\Update\Form\UpdateSpaceType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceById;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\UpdateSpace;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
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
        private FindSpaceById\Gateway $findSpaceGateway,
        private UrlGeneratorInterface $urlGenerator,
        private UpdateSpace\Gateway $updateSpaceGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_SPACES_UPDATE['path'],
        name: Routes::ADMIN_CMS_SPACES_UPDATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier, Request $request): Response
    {
        try {
            $space = $this->find($identifier);
        } catch (HttpExceptionInterface $exception) {
            return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_SPACES_INDEX['name']));
        }

        $form = $this->formFactory->create(UpdateSpaceType::class);
        $form->setData($space->getSpace());
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form, $space);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_SPACES_UPDATE['name'], [
                    'identifier' => $identifier,
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Space/update', [
            'form' => $form->createView(),
            'space' => $space,
        ]);
    }

    private function find(string $identifier): FindSpaceById\Response
    {
        try {
            /** @var FindSpaceById\Response $response */
            return ($this->findSpaceGateway)(FindSpaceById\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function process(FormInterface $form, FindSpaceById\Response $space): UpdateSpace\Response
    {
        /** @var UpdateSpaceDTO $data */
        $data = $form->getData();

        try {
            /** @var UpdateSpace\Response $response */
            $response = ($this->updateSpaceGateway)(UpdateSpace\Request::fromData(array_merge(
                $space->data(),
                $data->data()
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('space.updated.success', 'success');

        return $response;
    }
}
