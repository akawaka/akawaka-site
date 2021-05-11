<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Create\Form;

use App\UI\Admin\Form\Type\CategoryChoiceType;
use App\UI\Admin\Form\Type\ChannelChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CreateArticleType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = CreateArticleDTO::class;
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
            ->add('categories', CategoryChoiceType::class, [
                'label' => $this->translate('categories.label'),
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('channels', ChannelChoiceType::class, [
                'label' => $this->translate('channels.label'),
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
        ]);
    }

    private function translate(string $key): string
    {
        return \Safe\sprintf('admin.cms.ui.article.create.form.%s', $key);
    }
}
