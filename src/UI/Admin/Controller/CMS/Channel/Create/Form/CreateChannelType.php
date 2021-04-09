<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Channel\Create\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CreateChannelType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = CreateChannelDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translate('name.label'),
            ])
            ->add('code', TextType::class, [
                'label' => $this->translate('code.label'),
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
        return \Safe\sprintf('admin.cms.ui.channel.create.form.%s', $key);
    }
}
