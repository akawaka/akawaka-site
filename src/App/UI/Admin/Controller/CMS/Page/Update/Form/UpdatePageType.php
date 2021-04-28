<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\CMS\Page\Update\Form;

use App\UI\Admin\Common\Form\Type\PellType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdatePageType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = UpdatePageDTO::class;
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
            ->add('content', PellType::class, [
                'label' => $this->translate('content.label'),
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
        return \Safe\sprintf('admin.cms.ui.page.update.form.%s', $key);
    }
}
