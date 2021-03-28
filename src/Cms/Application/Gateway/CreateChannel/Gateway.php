<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\CreateChannel;

use App\Cms\Application\Operation\Write\CreateChannel\Command;
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
                $request->getCode(),
                $request->getName(),
            ));

            /** @var HandledStamp $handled */
            $handled = $envelope->last(HandledStamp::class);
            $response = new Response($handled->getResult());

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException(
                'Error during create channel process',
                $exception->getFile(),
                $exception->getMessage()
            );
        }
    }
}
