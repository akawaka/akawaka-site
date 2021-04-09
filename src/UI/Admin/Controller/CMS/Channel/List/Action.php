<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\List;

use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\Channel\Application\Gateway\FindChannels;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class Action
{
    public function __construct(
        private FindChannels\Gateway $findChannelsGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    public function __invoke(): Response
    {
        return ($this->htmlResponder)('Admin/CMS/Channel/list', [
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
