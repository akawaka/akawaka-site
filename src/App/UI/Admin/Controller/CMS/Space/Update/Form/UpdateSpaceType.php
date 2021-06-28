<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Space\Update\Form;

use Sylius\Bundle\ThemeBundle\Form\Type\ThemeNameChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdateSpaceType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = UpdateSpaceDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translate('name.label'),
            ])
            ->add('description', TextareaType::class, [
                'label' => $this->translate('description.label'),
                'required' => false,
            ])
            ->add('url', UrlType::class, [
                'label' => $this->translate('url.label'),
                'required' => false,
            ])
            ->add('theme', ThemeNameChoiceType::class, [
                'label' => $this->translate('theme.label'),
                'required' => false,
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
        return \Safe\sprintf('admin.cms.ui.space.update.form.%s', $key);
    }
}