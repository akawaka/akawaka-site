<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Delete;

use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Article\Application\Gateway\RemoveCategory;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private RemoveCategory\Gateway $removeCategoryGateway,
        private UrlGeneratorInterface $urlGenerator,
        private RedirectResponder $redirectResponder
    ) {
    }

    public function __invoke(string $identifier): Response
    {
        try {
            ($this->removeCategoryGateway)(RemoveCategory\Request::fromData([
                'identifier' => $identifier,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return ($this->redirectResponder)($this->urlGenerator->generate('admin_categories_index'));
    }
}
