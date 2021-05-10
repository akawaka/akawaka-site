<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\FindChannelById;

use Mono\Component\Channel\Application\Operation\Read\FindById;
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
            $channel = ($this->queryBus)(new FindById\Query($request->getIdentifier()));
            $response = new Response($channel);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find channel by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}
