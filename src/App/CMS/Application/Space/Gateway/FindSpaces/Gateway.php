<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\FindSpaces;

use App\CMS\Application\Space\Operation\Read\FindAll\Query;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

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
            $spaces = ($this->queryBus)(new Query());

            $response = new Response();
            foreach ($spaces as $space) {
                $response->addSpace($space);
            }

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find spaces process', $exception->getFile(), $exception->getMessage());
        }
    }
}
