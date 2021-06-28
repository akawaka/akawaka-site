<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\UpdateArticle;

use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Article\Application\Operation\Article\Write\Update\Command;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $response = new Response(($this->commandBus)(new Command(
                $request->getIdentifier(),
                $request->getName(),
                $request->getSlug(),
                $request->getContent(),
                $request->getCategories(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during update article process', $exception->getFile(), $exception->getMessage());
        }
    }
}
