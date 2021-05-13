<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Gateway\Register;

use Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Operation\Write\Register;
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
            $response = new Response(($this->commandBus)(new Register\Command(
                $request->getUsername(),
                $request->getEmail(),
                $request->getPassword(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during admin registration process', $exception->getFile(), $exception->getMessage());
        }
    }
}
