<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\ResetPassword;

use Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Gateway\ResetPassword;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Controller\Security\ResetPassword\Form\ResetPasswordDTO;
use App\UI\Admin\Controller\Security\ResetPassword\Form\ResetPasswordType;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private ResetPassword\Gateway $recoverGateway,
        private FormFactoryInterface $formFactory,
        private HtmlResponder $htmlResponder,
        private RedirectResponder $redirectResponder,
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_SECURITY_PASSWORD_RESET['path'],
        name: Routes::ADMIN_SECURITY_PASSWORD_RESET['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(ResetPasswordType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_SECURITY_PASSWORD_RESET_SUCCESS['name'])
            );
        }

        return ($this->htmlResponder)('Admin/Security/Reset/reset', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): ResetPassword\Response
    {
        /** @var ResetPasswordDTO $data */
        $data = $form->getData();

        try {
            return ($this->recoverGateway)(ResetPassword\Request::fromData(
                $data->toArray()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }
}
