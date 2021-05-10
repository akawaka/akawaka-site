<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\FindChannels;

use Mono\Component\Channel\Application\Operation\Read\FindAll\Query;
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
            $channels = ($this->queryBus)(new Query());

            $response = new Response();
            foreach ($channels as $channel) {
                $response->addChannel($channel);
            }

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find channels process', $exception->getFile(), $exception->getMessage());
        }
    }
}
