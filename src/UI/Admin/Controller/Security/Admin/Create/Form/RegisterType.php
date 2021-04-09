<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Create\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class RegisterType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = RegisterDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => $this->translate('username.label'),
            ])
            ->add('email', EmailType::class, [
                'label' => $this->translate('email.label'),
            ])
            ->add('password', RepeatedType::class, [
                'label' => $this->translate('password.label'),
                'type' => PasswordType::class,
                'first_options' => ['label' => 'password.first.label'],
                'second_options' => ['label' => 'password.second.label'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'factory' => $this->class,
            'immutable' => true,

        ]);
    }

    private function translate(string $key): string
    {
        return \Safe\sprintf('admin.security.ui.admin.create.%s', $key);
    }
}
