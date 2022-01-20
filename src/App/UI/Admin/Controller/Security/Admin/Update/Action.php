<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Update;

use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Controller\Security\Admin\Update\Form\UpdateAdminDTO;
use App\UI\Admin\Controller\Security\Admin\Update\Form\UpdateAdminType;
use App\UI\Admin\Controller\Security\Admin\Update\Form\UpdatePasswordDTO;
use App\UI\Admin\Controller\Security\Admin\Update\Form\UpdatePasswordType;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\FindUserById;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdatePassword;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Gateway\UpdateUser;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\CoreBundle\UI\Responder\RedirectResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Action
{
    public function __construct(
        private FindUserById\Gateway $findUserGateway,
        private UrlGeneratorInterface $urlGenerator,
        private UpdateUser\Gateway $updateUserGateway,
        private UpdatePassword\Gateway $updatePasswordGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_SECURITY_ADMINS_UPDATE['path'],
        name: Routes::ADMIN_SECURITY_ADMINS_UPDATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(string $identifier, Request $request): Response
    {
        try {
            $admin = $this->find($identifier);
        } catch (HttpExceptionInterface $exception) {
            return ($this->redirectResponder)($this->urlGenerator->generate(Routes::ADMIN_SECURITY_ADMINS_INDEX['name']));
        }

        $updateAdminForm = $this->formFactory->create(UpdateAdminType::class);
        $updatePasswordForm = $this->formFactory->create(UpdatePasswordType::class);

        $updateAdminForm->setData($admin->getUser());

        if ('POST' === $request->getMethod()) {
            if ($request->request->has('update_admin')) {
                $updateAdminForm->handleRequest($request);

                if (true === $updateAdminForm->isSubmitted() && true === $updateAdminForm->isValid()) {
                    $this->processUpdate($updateAdminForm, $admin);

                    return ($this->redirectResponder)(
                        $this->urlGenerator->generate(Routes::ADMIN_SECURITY_ADMINS_UPDATE['name'], [
                            'identifier' => $identifier,
                        ])
                    );
                }
            }

            if ($request->request->has('update_password')) {
                $updatePasswordForm->handleRequest($request);

                if (true === $updatePasswordForm->isSubmitted() && true === $updatePasswordForm->isValid()) {
                    $this->processPassword($updatePasswordForm, $admin);

                    return ($this->redirectResponder)(
                        $this->urlGenerator->generate(Routes::ADMIN_SECURITY_ADMINS_UPDATE['name'], [
                            'identifier' => $identifier,
                        ])
                    );
                }
            }
        }

        return ($this->htmlResponder)('Admin/Security/Admin/update', [
            'updateAdminForm' => $updateAdminForm->createView(),
            'updatePasswordForm' => $updatePasswordForm->createView(),
            'admin' => $admin,
        ]);
    }

    private function find(string $identifier): FindUserById\Response
    {
        try {
            /** @var FindUserById\Response $response */
            $response = ($this->findUserGateway)(FindUserById\Request::fromData([
                'identifier' => $identifier,
            ]));

            return $response;
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function processUpdate(FormInterface $form, FindUserById\Response $admin): UpdateUser\Response
    {
        /** @var UpdateAdminDTO $data */
        $data = $form->getData();

        try {
            /** @var UpdateUser\Response $response */
            $response = ($this->updateUserGateway)(UpdateUser\Request::fromData(array_merge(
                $admin->data(),
                $data->data()
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('admin_user.updated.success', 'success');

        return $response;
    }

    private function processPassword(FormInterface $form, FindUserById\Response $admin): UpdatePassword\Response
    {
        /** @var UpdatePasswordDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->updatePasswordGateway)(UpdatePassword\Request::fromData(array_merge(
                $admin->data(),
                ['password' => $data->getNewPassword()],
            )));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        ($this->flashNotifier)('admin_user.password_updated.success', 'success');

        return $response;
    }
}
