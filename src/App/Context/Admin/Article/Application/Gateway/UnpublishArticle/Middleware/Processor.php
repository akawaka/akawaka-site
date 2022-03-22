<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Gateway\UnpublishArticle\Middleware;

use App\Context\Admin\Article\Application\Gateway\UnpublishArticle\Request;
use App\Context\Admin\Article\Application\Gateway\UnpublishArticle\Response;
use App\Context\Admin\Article\Application\Operation\Write\Unpublish\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->commandBus)(new Command(
            $request->getIdentifier()
        )));
    }
}
