<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindUserById;

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
        $this->logger->info('user.find_by_id', $request->data());
    }

    public function success(Response $response): void
    {
        $this->logger->info('user.find_by_id.success', $response->data());
    }

    public function error(Request $request, string $reason): void
    {
        $this->logger->error('user.find_by_id.error', array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}
