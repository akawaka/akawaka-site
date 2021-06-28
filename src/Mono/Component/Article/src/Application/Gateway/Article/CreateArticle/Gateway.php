<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\CreateArticle;

use Mono\Component\Article\Application\Operation\Article\Write\Create\Command;
use Mono\Component\Article\Infrastructure\Identity\ArticleIdentityGenerator;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private ArticleIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $identity = $this->identityGenerator->nextIdentity();
            $command = ($this->commandBus)(new Command(
                $identity,
                $request->getName(),
                $request->getSlug(),
                $request->getCategories(),
            ));

            $response = new Response($identity, $command);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during create article process', $exception->getFile(), $exception->getMessage());
        }
    }
}
