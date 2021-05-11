<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Instrumentation;

use Psr\Log\LoggerInterface;

class LoggerInstrumentation implements Instrumentation
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}