<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Delete;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Channel\Application\Gateway\RemoveChannel;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private RemoveChannel\Gateway $removeChannelGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_CHANNELS_DELETE['path'],
        name: RouteName::ADMIN_CMS_CHANNELS_DELETE['name'],
        methods: ['GET']
    )]
    public function __invoke(string $identifier): Response
    {
        try {
            ($this->removeChannelGateway)(RemoveChannel\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return ($this->redirectResponder)($this->urlGenerator->generate(RouteName::ADMIN_CMS_CHANNELS_INDEX['name']));
    }
}
