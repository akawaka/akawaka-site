<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Create;

use App\CMS\Application\Gateway\CreateChannel;
use App\UI\Admin\Controller\CMS\Channel\Create\Form\CreateChannelDTO;
use App\UI\Admin\Controller\CMS\Channel\Create\Form\CreateChannelType;
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
        private CreateChannel\Gateway $createChannelGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_CHANNELS_CREATE['path'],
        name: RouteName::ADMIN_CMS_CHANNELS_CREATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreateChannelType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $channel = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(RouteName::ADMIN_CMS_CHANNELS_UPDATE['name'], [
                    'identifier' => $channel->data()['identifier'],
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Channel/create', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): CreateChannel\Response
    {
        /** @var CreateChannelDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->createChannelGateway)(CreateChannel\Request::fromData(
                $data->data()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('channel.created.success', 'success');

        return $response;
    }
}
