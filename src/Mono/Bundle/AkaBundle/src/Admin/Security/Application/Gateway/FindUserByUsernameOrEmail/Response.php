<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\FindUserByUsernameOrEmail;

use Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\UserResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use UserResponse;
}
