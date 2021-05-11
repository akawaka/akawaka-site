<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Create\Form;

use App\UI\Admin\Form\Type\ChannelChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CreatePageType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = CreatePageDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translate('name.label'),
            ])
            ->add('slug', TextType::class, [
                'label' => $this->translate('slug.label'),
                'required' => false,
            ])
            ->add('channels', ChannelChoiceType::class, [
                'label' => $this->translate('channel.label'),
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'factory' => $this->class,
            'immutable' => true,
            'label' => false,
        ]);
    }

    private function translate(string $key): string
    {
        return \Safe\sprintf('admin.cms.ui.page.create.form.%s', $key);
    }
}
