<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\UpdateSpace;

use App\CMS\Application\Space\Operation\Write\Update;
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
            $response = new Response(($this->commandBus)(new Update\Command(
                $request->getIdentifier(),
                $request->getName(),
                $request->getUrl(),
                $request->getDescription(),
                $request->getTheme(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during update space process', $exception->getFile(), $exception->getMessage());
        }
    }
}
