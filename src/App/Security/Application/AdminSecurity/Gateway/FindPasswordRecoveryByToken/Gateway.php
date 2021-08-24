<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindPasswordRecoveryByToken;

use App\Security\Application\AdminSecurity\Operation\Read\FindPasswordRecoveryByToken;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $recovery = ($this->queryBus)(new FindPasswordRecoveryByToken\Query($request->getToken()));

            $response = new Response($recovery);
            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find user by id process', $exception->getFile(), $exception->getMessage());
        }
    }
}
