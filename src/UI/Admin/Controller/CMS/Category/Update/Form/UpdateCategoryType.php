<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Category\Update\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdateCategoryType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = UpdateCategoryDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translate('name.label'),
            ])
            ->add('slug', TextType::class, [
                'label' => $this->translate('slug.label'),
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
        return \Safe\sprintf('admin.cms.ui.category.update.form.%s', $key);
    }
}
