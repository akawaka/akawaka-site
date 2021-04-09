<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\CreatePage;

use App\CMS\Application\Operation\Write\CreatePage\Command;
use Mono\Component\Channel\Application\Operation\Read\FindById;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);
        $channels = [];

        try {
            foreach ($request->getChannels() as $channel) {
                $channels[] = ($this->queryBus)(new FindById\Query(
                    $channel,
                ));
            }

            $response = new Response(($this->commandBus)(new Command(
                $request->getName(),
                $request->getSlug(),
                $channels,
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during create page process', $exception->getFile(), $exception->getMessage());
        }
    }
}
