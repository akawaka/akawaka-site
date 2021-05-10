<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\FindPages;

use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;
use Mono\Component\Page\Application\Operation\Read\FindAll\Query;

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
            $pages = ($this->queryBus)(new Query());

            $response = new Response();
            foreach ($pages as $page) {
                $response->add($page);
            }

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find pages process', $exception->getFile(), $exception->getMessage());
        }
    }
}
