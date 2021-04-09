<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\UpdateUser;

use Mono\Component\AdminSecurity\Application\Gateway\Default\UserResponse;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use UserResponse;
}
