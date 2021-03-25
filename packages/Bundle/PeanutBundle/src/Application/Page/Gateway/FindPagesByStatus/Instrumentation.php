<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus;

use Black\Bundle\CoreBundle\Infrastructure\Instrumentation\PsrInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(PsrInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function find(FindPagesByStatusRequest $request): void
    {
        $this->logger->info('pages.find', $request->data());
    }

    public function found(FindPagesByStatusResponse $response): void
    {
        $this->logger->info('pages.found', $response->data());
    }

    public function notFound(FindPagesByStatusRequest $request, string $reason): void
    {
        $this->logger->error('pages.not_found', array_merge($request->data(),
            ['reason' => $reason]
        ));
    }
}
