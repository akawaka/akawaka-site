<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\CreateSpace;

use App\CMS\Application\Space\Operation\Write\Create\Command;
use App\CMS\Infrastructure\Identity\SpaceIdentityGenerator;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private SpaceIdentityGenerator $identityGenerator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $identity = $this->identityGenerator->nextIdentity();
            $command = ($this->commandBus)(new Command(
                $identity,
                $request->getCode(),
                $request->getName(),
                $request->getTheme(),
            ));

            $response = new Response($identity, $command);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during create space process', $exception->getFile(), $exception->getMessage());
        }
    }
}
