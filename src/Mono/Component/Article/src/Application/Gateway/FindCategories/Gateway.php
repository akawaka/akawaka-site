<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindCategories;

use Mono\Component\Article\Application\Operation\Read\FindAllCategories;
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
            $categories = ($this->queryBus)(new FindAllCategories\Query());
            $response = new Response();

            foreach ($categories as $category) {
                $response->add($category);
            }

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find categories process', $exception->getFile(), $exception->getMessage());
        }
    }
}