<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Gateway\RemoveChannel;

use Mono\Component\Channel\Application\Operation\Write\Remove;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $response = new Response(($this->commandBus)(new Remove\Command(
                $request->getIdentifier()
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during remove channel process', $exception->getFile(), $exception->getMessage());
        }
    }
}
