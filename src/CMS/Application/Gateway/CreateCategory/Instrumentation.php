<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\CreateCategory;

use Mono\Component\Core\Infrastructure\Instrumentation\LoggerInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(LoggerInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function start(Request $request): void
    {
        $this->logger->info('category.create', $request->data());
    }

    public function success(Response $response): void
    {
        $this->logger->info('category.create_success', $response->data());
    }

    public function error(Request $request, string $reason): void
    {
        $this->logger->error('category.create_error', array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}
