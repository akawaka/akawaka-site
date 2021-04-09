<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Article\Update\Form;

use App\UI\Admin\Common\Form\Type\CategoryChoiceType;
use App\UI\Admin\Common\Form\Type\FroalaType;
use App\UI\Admin\Common\Form\Type\PellType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdateArticleType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = UpdateArticleDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translate('name.label'),
            ])
            ->add('slug', TextType::class, [
                'label' => $this->translate('slug.label'),
            ])
            ->add('content', FroalaType::class, [
                'label' => $this->translate('content.label'),
                'required' => false,
            ])
            ->add('categories', CategoryChoiceType::class, [
                'label' => $this->translate('categories.label'),
                'multiple' => true,
                'expanded' => true,
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
        return \Safe\sprintf('admin.cms.ui.article.update.form.%s', $key);
    }
}
