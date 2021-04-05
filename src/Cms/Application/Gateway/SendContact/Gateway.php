<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\SendContact;

use App\Cms\Application\Operation\Write\SendContact\Command;
use Black\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class Gateway
{
    private Instrumentation $instrumentation;

    private MessageBusInterface $commandBus;

    public function __construct(
        Instrumentation $instrumentation,
        MessageBusInterface $commandBus,
    ) {
        $this->instrumentation = $instrumentation;
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $envelope = $this->commandBus->dispatch(new Command(
                $request->getFirstname(),
                $request->getLastname(),
                $request->getEmail(),
                $request->getPhone(),
                $request->getMessage(),
                $request->getBudget(),
                $request->getHow(),
            ));

            /** @var HandledStamp $handled */
            $envelope->last(HandledStamp::class);
            $response = new Response();

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException(
                'Error during send contact process',
                $exception->getFile(),
                $exception->getMessage()
            );
        }
    }
}
