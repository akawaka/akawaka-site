<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\ResetPassword;

use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Controller\Security\ResetPassword\Form\ResetPasswordDTO;
use App\UI\Admin\Controller\Security\ResetPassword\Form\ResetPasswordType;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
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
        private CreatePasswordRecovery\Gateway $resetPasswordGateway,
        private FormFactoryInterface $formFactory,
        private HtmlResponder $htmlResponder,
        private RedirectResponder $redirectResponder,
        private UrlGeneratorInterface $urlGenerator,
        private FlashNotifier $flashNotifier,
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

            ($this->flashNotifier)('admin_security.password_recovered', 'success');

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_SECURITY_PASSWORD_RESET_SUCCESS['name'])
            );
        }

        return ($this->htmlResponder)('Admin/Security/Reset/reset', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): CreatePasswordRecovery\Response
    {
        /** @var ResetPasswordDTO $data */
        $data = $form->getData();

        try {
            /** @var CreatePasswordRecovery\Response $response */
            return ($this->resetPasswordGateway)(CreatePasswordRecovery\Request::fromData(
                $data->toArray()
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }
}
