<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\FindPageById;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Page\Application\Gateway\PageResponse;

final class Response implements GatewayResponse
{
    use PageResponse;
}
