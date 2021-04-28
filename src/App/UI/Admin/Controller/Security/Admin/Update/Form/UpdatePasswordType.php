<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Update\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdatePasswordType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = UpdatePasswordDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => $this->translate('oldPassword.label'),
            ])
            ->add('newPassword', RepeatedType::class, [
                'label' => $this->translate('password.label'),
                'type' => PasswordType::class,
                'first_options' => ['label' => 'password.first.label'],
                'second_options' => ['label' => 'password.second.label'],
            ])
        ;
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
        return \Safe\sprintf('admin.security.ui.admin.update_password.%s', $key);
    }
}
