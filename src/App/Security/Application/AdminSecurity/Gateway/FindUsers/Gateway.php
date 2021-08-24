<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindUsers;

use App\Security\Application\AdminSecurity\Operation\Read\FindAllUsers;
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
            $users = ($this->queryBus)(new FindAllUsers\Query());
            $response = new Response();

            foreach ($users as $user) {
                $response->add($user);
            }

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find users process', $exception->getFile(), $exception->getMessage());
        }
    }
}
