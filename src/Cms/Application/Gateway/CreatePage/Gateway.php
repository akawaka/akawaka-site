<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\CreatePage;

use App\Cms\Application\Operation\Write\CreatePage\Command;
use Black\Component\Channel\Application\Operation\Read\FindById;
use Black\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class Gateway
{
    private Instrumentation $instrumentation;

    private MessageBusInterface $queryBus;

    private MessageBusInterface $commandBus;

    public function __construct(
        Instrumentation $instrumentation,
        MessageBusInterface $queryBus,
        MessageBusInterface $commandBus,
    ) {
        $this->instrumentation = $instrumentation;
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $envelope = $this->queryBus->dispatch(new FindById\Query(
                $request->getChannel(),
            ));

            /** @var HandledStamp $handled */
            $handled = $envelope->last(HandledStamp::class);

            $envelope = $this->commandBus->dispatch(new Command(
                $request->getName(),
                $request->getSlug(),
                $handled->getResult(),
            ));

            /** @var HandledStamp $handled */
            $handled = $envelope->last(HandledStamp::class);
            $response = new Response($handled->getResult());

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException(
                'Error during create page process',
                $exception->getFile(),
                $exception->getMessage()
            );
        }
    }
}
