<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\FindPageBySlug;

use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;
use Mono\Component\Page\Application\Operation\Read\FindBySlug\Query;
use Mono\Component\Page\Application\Gateway\FindPageBySlug\Instrumentation;
use Mono\Component\Page\Application\Gateway\FindPageBySlug\Request;

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
            $response = new Response(
                ($this->queryBus)(new Query($request->getSlug()))
            );

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find page by slug process', $exception->getFile(), $exception->getMessage());
        }
    }
}