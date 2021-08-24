<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\UpdateUser;

use App\Security\Application\AdminSecurity\Operation\Write\UpdateUser;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

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
            $response = new Response(($this->commandBus)(new UpdateUser\Command(
                $request->getIdentifier(),
                $request->getUsername(),
                $request->getEmail(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during update user process', $exception->getFile(), $exception->getMessage());
        }
    }
}
