<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Update;

use App\UI\Admin\Controller\CMS\Channel\Update\Form\UpdateChannelDTO;
use App\UI\Admin\Controller\CMS\Channel\Update\Form\UpdateChannelType;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Channel\Application\Gateway\FindChannelById;
use Mono\Bundle\AoBundle\CMS\Application\Gateway\UpdateChannel;
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
        private FindChannelById\Gateway $findChannelGateway,
        private UrlGeneratorInterface $urlGenerator,
        private UpdateChannel\Gateway $updateChannelGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_CMS_CHANNELS_UPDATE['path'],
        name: Routes::ADMIN_CMS_CHANNELS_UPDATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier, Request $request): Response
    {
        try {
            $channel = $this->find($identifier);
        } catch (HttpExceptionInterface $exception) {
            return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_CMS_CHANNELS_INDEX['name']));
        }

        $form = $this->formFactory->create(UpdateChannelType::class);
        $form->setData($channel->getChannel());
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form, $channel);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_CMS_CHANNELS_UPDATE['name'], [
                    'identifier' => $identifier,
                ])
            );
        }

        return ($this->htmlResponder)('Admin/CMS/Channel/update', [
            'form' => $form->createView(),
            'channel' => $channel,
        ]);
    }

    private function find(string $identifier): FindChannelById\Response
    {
        try {
            return ($this->findChannelGateway)(FindChannelById\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function process(FormInterface $form, FindChannelById\Response $channel): UpdateChannel\Response
    {
        /** @var UpdateChannelDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->updateChannelGateway)(UpdateChannel\Request::fromData(array_merge(
                $channel->data(),
                $data->data()
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('channel.updated.success', 'success');

        return $response;
    }
}
