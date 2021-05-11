<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindArticleById;

use Mono\Component\Article\Application\Operation\Read\FindArticleById;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $article = ($this->queryBus)(new FindArticleById\Query($request->getIdentifier()));
            $response = new Response($article);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find article by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}