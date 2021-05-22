<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\CreatePage;

use App\CMS\Application\Operation\Write\CreatePage\Command;
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
            $response = new Response(($this->commandBus)(new Command(
                $request->getName(),
                $request->getSlug(),
                $request->getSpaces(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during create page process', $exception->getFile(), $exception->getMessage());
        }
    }
}
