<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Gateway\FindSpaceByHostname;

use Mono\Component\Space\Application\Operation\Read\FindByHostname;
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
            $space = ($this->queryBus)(new FindByHostname\Query($request->getHostname()));
            $response = new Response($space);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find space by hostname process', $exception->getFile(), $exception->getMessage());
        }
    }
}
