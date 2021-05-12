<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Create;

use App\Security\Application\AdminSecurity\Gateway\Register;
use App\UI\Admin\Controller\Routes;
use App\UI\Admin\Controller\Security\Admin\Create\Form\RegisterDTO;
use App\UI\Admin\Controller\Security\Admin\Create\Form\RegisterType;
use App\UI\Admin\Notifier\Flash\FlashNotifier;
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
        private UrlGeneratorInterface $urlGenerator,
        private Register\Gateway $registerGateway,
        private FormFactoryInterface $formFactory,
        private RedirectResponder $redirectResponder,
        private HtmlResponder $htmlResponder,
        private FlashNotifier $flashNotifier,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_SECURITY_ADMINS_CREATE['path'],
        name: Routes::ADMIN_SECURITY_ADMINS_CREATE['name'],
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(RegisterType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $admin = $this->process($form);

            return ($this->redirectResponder)(
                $this->urlGenerator->generate(Routes::ADMIN_SECURITY_ADMINS_UPDATE['name'], [
                    'identifier' => $admin->data()['identifier'],
                ])
            );
        }

        return ($this->htmlResponder)('Admin/Security/Admin/create', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): Register\Response
    {
        /** @var RegisterDTO $data */
        $data = $form->getData();

        try {
            $response = ($this->registerGateway)(Register\Request::fromData(
                $data->toArray()
            ));

            ($this->flashNotifier)('admin_user.registered.success', 'success');
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $response;
    }
}
