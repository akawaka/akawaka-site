<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\PublishArticle;

use Mono\Component\Article\Application\Operation\Read\FindArticleById;
use Mono\Component\Article\Application\Operation\Write\PublishArticle;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $article = ($this->queryBus)(new FindArticleById\Query($request->getIdentifier()));
            $response = new Response(($this->commandBus)(new PublishArticle\Command($article)));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during publish article process', $exception->getFile(), $exception->getMessage());
        }
    }
}
