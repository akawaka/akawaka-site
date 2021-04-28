<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Contact\Form;

use App\UI\Front\Controller\Contact\Form\Enum\BudgetEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ContactType extends AbstractType
{
    private string $class;

    public function __construct()
    {
        $this->class = ContactDTO::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => $this->translate('firstname.label'),
            ])
            ->add('lastname', TextType::class, [
                'label' => $this->translate('lastname.label'),
            ])
            ->add('email', EmailType::class, [
                'label' => $this->translate('email.label'),
            ])
            ->add('phone', TelType::class, [
                'label' => $this->translate('phone.label'),
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'label' => $this->translate('message.label'),
            ])
            ->add('budget', ChoiceType::class, [
                'label' => $this->translate('budget.label'),
                'choices' => BudgetEnum::getValues(),
                'expanded' => true,
            ])
            ->add('how', TextType::class, [
                'label' => $this->translate('how.label'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'factory' => $this->class,
            'immutable' => true,
            'translation_domain' => 'form',
        ]);
    }

    private function translate(string $key): string
    {
        return \Safe\sprintf('front.contact.%s', $key);
    }
}
