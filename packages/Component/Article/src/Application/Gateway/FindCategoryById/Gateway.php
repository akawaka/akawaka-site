<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindCategoryById;

use Mono\Component\Article\Application\Operation\Read\FindCategoryById;
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
            $category = ($this->queryBus)(new FindCategoryById\Query($request->getIdentifier()));
            $response = new Response($category);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find category by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}
