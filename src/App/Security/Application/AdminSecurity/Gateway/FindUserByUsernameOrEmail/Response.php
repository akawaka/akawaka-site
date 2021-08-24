<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindUserByUsernameOrEmail;

use App\Security\Application\AdminSecurity\Gateway\UserResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use UserResponse;
}
