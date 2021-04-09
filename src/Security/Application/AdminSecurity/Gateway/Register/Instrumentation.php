<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\Register;

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
        unset($request->data()['password']);

        $this->logger->info('admin_security.register', $request->data());
    }

    public function success(Response $response): void
    {
        $this->logger->info('admin_security.register.success', $response->data());
    }

    public function error(Request $request, string $reason): void
    {
        unset($request->data()['password']);

        $this->logger->error('admin_security.register.error', array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}
