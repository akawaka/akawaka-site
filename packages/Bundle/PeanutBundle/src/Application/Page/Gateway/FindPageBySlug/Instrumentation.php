<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageBySlug;

use Black\Bundle\CoreBundle\Infrastructure\Instrumentation\PsrInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(PsrInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function find(FindPageBySlugRequest $request): void
    {
        $this->logger->info('page.find', $request->data());
    }

    public function found(FindPageBySlugResponse $response): void
    {
        $this->logger->info('page.found', $response->data());
    }

    public function notFound(FindPageBySlugRequest $request, string $reason): void
    {
        $this->logger->error('page.not_found', array_merge($request->data(),
            ['reason' => $reason]
        ));
    }
}
