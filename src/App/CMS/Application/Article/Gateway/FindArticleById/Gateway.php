<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindArticleById;

use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;
use Mono\Component\Article\Application\Operation\Article\Read\FindById\Query;
use Mono\Component\Article\Application\Gateway\Article\FindArticleById\Instrumentation;
use Mono\Component\Article\Application\Gateway\Article\FindArticleById\Request;

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
            $response = new Response(($this->queryBus)(
                new Query($request->getIdentifier())
            ));
            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find article by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}
