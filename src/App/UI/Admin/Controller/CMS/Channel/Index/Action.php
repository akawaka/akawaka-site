<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Index;

use App\UI\Admin\Controller\RouteName;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\Channel\Application\Gateway\FindChannels;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private FindChannels\Gateway $findChannelsGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    #[Route(
        path: RouteName::ADMIN_CMS_CHANNELS_INDEX['path'],
        name: RouteName::ADMIN_CMS_CHANNELS_INDEX['name'],
        methods: ['GET']
    )]
    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Channel/index', [
            'results' => $this->find()->data(),
        ]);
    }

    private function find(): FindChannels\Response
    {
        try {
            $results = ($this->findChannelsGateway)(FindChannels\Request::fromData());
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $results;
    }
}
