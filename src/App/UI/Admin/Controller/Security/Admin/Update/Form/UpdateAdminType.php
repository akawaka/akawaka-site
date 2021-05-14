<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Update\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdateAdminType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = UpdateAdminDTO::class;
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
        return \Safe\sprintf('admin.security.ui.admin.update.form.%s', $key);
    }
}
