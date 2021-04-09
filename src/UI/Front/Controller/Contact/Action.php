<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Contact;

use App\CMS\Application\Gateway\SendContact;
use App\UI\Front\Controller\Contact\Form\ContactType;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class Action
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private SendContact\Gateway $sendContactGateway,
        private HtmlResponder $htmlResponder
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(ContactType::class);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $this->process($form);
        }

        return ($this->htmlResponder)('front/contact', [
            'form' => $form->createView(),
        ]);
    }

    private function process(FormInterface $form): SendContact\Response
    {
        try {
            $response = ($this->sendContactGateway)(SendContact\Request::fromData(
                $form->getData()->data(),
            ));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }

        return $response;
    }
}
