<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindCategoryBySlug;

use App\CMS\Application\Article\Operation\Read\FindCategoryBySlug;
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
            $category = ($this->queryBus)(new FindCategoryBySlug\Query($request->getSlug()));
            $response = new Response($category);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find category by slug process', $exception->getFile(), $exception->getMessage());
        }
    }
}
