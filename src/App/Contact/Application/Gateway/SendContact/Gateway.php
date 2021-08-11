<?php

declare(strict_types=1);

namespace App\Contact\Application\Gateway\SendContact;

use App\Contact\Application\Operation\Write\Send\Command;
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
            ($this->commandBus)(new Command(
                $request->getFirstname(),
                $request->getLastname(),
                $request->getEmail(),
                $request->getPhone(),
                $request->getMessage(),
                $request->getBudget(),
                $request->getHow(),
            ));

            $response = new Response();

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during send contact process', $exception->getFile(), $exception->getMessage());
        }
    }
}
