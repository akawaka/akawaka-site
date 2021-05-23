<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindUserById;

use App\Security\Application\AdminSecurity\Gateway\UserResponse;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use UserResponse;
}
