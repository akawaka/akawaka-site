<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\UnpublishArticle\Middleware;

use App\CMS\Application\Article\Gateway\UnpublishArticle\Request;
use App\CMS\Application\Article\Gateway\UnpublishArticle\Response;
use App\CMS\Application\Article\Operation\Write\Unpublish\Command;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class ProcessorMiddleware
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
